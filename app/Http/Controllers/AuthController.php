<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        return view('login-register');
    }

    public function showRegisterForm()
    {
        return view('login-register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'ho_ten' => 'required|string|max:100',
                'tai_khoan' => 'required|string|max:100|unique:nguoi_dung,tai_khoan',
                'mat_khau' => 'required|string|min:8|max:20',
                'so_dien_thoai' => 'required|string|min:10|max:10|unique:nguoi_dung,so_dien_thoai',
                'email' => 'required|string|email|max:50|unique:nguoi_dung,email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
            ]);

            $newId = $this->generateCustomerId();

            NguoiDung::create([
                'id' => $newId,
                'ho_ten' => $request->ho_ten,
                'tai_khoan' => $request->tai_khoan,
                'mat_khau' => Crypt::encrypt($request->mat_khau),
                'so_dien_thoai' => $request->so_dien_thoai,
                'email' => $request->email,
                'avatar' => '',
                'vai_tro' => 'Khách Hàng',
            ]);

            return redirect()->route('login')->with('success', 'Đăng ký thành công!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with('error', 'Tài khoản, số điện thoại hoặc Email đã tồn tại!');
            }
            return back()->with('error', 'Lỗi cơ sở dữ liệu, vui lòng thử lại!');
        } catch (Exception $e) {
            return back()->with('error', $this->getValidationErrorMessage($e->getMessage()));
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'tai_khoan' => 'required|string',
            'mat_khau' => 'required|string',
        ]);

        $user = NguoiDung::where('tai_khoan', $request->tai_khoan)->first();

        if (!$user || !$this->verifyPassword($user, $request->mat_khau)) {
            return back()->withErrors(['tai_khoan' => 'Tài khoản hoặc mật khẩu không chính xác.']);
        }

        Auth::login($user);
        return $this->redirectAfterLogin($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Đăng xuất thành công!');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect()->route('homepage')->with('success', 'Đăng xuất thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Profile Management
    |--------------------------------------------------------------------------
    */

    public function showProfile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $this->updateProfile($request);
        return redirect()->route('thong_tin_ca_nhan')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function showChangePasswordForm()
    {
        return view('auth.doi_mat_khau');
    }

    public function changePassword(Request $request)
    {
        $result = $this->handlePasswordChange($request);

        if ($result !== true) {
            return back()->withErrors($result);
        }

        return redirect()->route('thong_tin_ca_nhan')->with('success', 'Đổi mật khẩu thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | Customer Profile Management
    |--------------------------------------------------------------------------
    */

    public function showProfileUser()
    {
        $user = Auth::user();
        return view('auth.user.profile', compact('user'));
    }

    public function editUser()
    {
        $user = Auth::user();
        return view('auth.user.edit-profile', compact('user'));
    }

    public function updateUser(Request $request)
    {
        $this->updateProfile($request);
        return redirect()->route('thong_tin_ca_nhan_user')->with('success', 'Cập nhật thông tin thành công!');
    }

    public function showChangePasswordFormUser()
    {
        return view('auth.user.doi_mat_khau');
    }

    public function changePasswordUser(Request $request)
    {
        $result = $this->handlePasswordChange($request);

        if ($result !== true) {
            return back()->withErrors($result);
        }

        return redirect()->route('thong_tin_ca_nhan_user')->with('success', 'Đổi mật khẩu thành công!');
    }

    /*
    |--------------------------------------------------------------------------
    | Google OAuth
    |--------------------------------------------------------------------------
    */

    public function dieuHuongDenGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function xuLyGoogle()
    {
        /** 
         * @var \Laravel\Socialite\Two\User $googleUser 
         * @phpstan-ignore-next-line - stateless() is a valid Socialite method
         */
        $googleUser = Socialite::driver('google')->stateless()->user();
        $newId = $this->generateCustomerId();

        $user = NguoiDung::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'id' => $newId,
                'ho_ten' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'so_dien_thoai' => null,
                'mat_khau' => Crypt::encrypt('google_default'),
                'vai_tro' => 'Khách Hàng',
                'dang_nhap_qua' => 'email',
            ]
        );

        Auth::login($user, true);

        if (!$user->so_dien_thoai) {
            return redirect()->route('thay_doi_thong_tin_user');
        }

        return redirect()->route('homepage');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Generate new customer ID
     */
    private function generateCustomerId(): string
    {
        $lastUser = NguoiDung::selectRaw("CAST(SUBSTRING(id, 4) AS UNSIGNED) as so_nguoi, id")
            ->where('id', 'like', 'KH-%')
            ->orderBy('so_nguoi', 'desc')
            ->first();

        if ($lastUser) {
            $nextNumber = ($lastUser->so_nguoi + 1);
            $length = max(3, strlen((string) $nextNumber));
            return 'KH-' . str_pad($nextNumber, $length, '0', STR_PAD_LEFT);
        }

        return 'KH-001';
    }

    /**
     * Verify user password
     */
    private function verifyPassword(NguoiDung $user, string $password): bool
    {
        try {
            $decryptedPassword = Crypt::decrypt($user->mat_khau);
            return $password === $decryptedPassword;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Redirect user after successful login
     */
    private function redirectAfterLogin(NguoiDung $user)
    {
        $adminRoles = ['admin', 'Nhân Viên Quản Lý Website', 'Nhân Viên Chăm Sóc Khách Hàng', 'Nhân Viên Thống Kê'];

        if (in_array($user->vai_tro, $adminRoles)) {
            return redirect()->route('bangdieukhien');
        }

        return redirect()->route('homepage');
    }

    /**
     * Get validation error message
     */
    private function getValidationErrorMessage(string $message): string
    {
        $errorMap = [
            'The email has already been taken.' => 'Email đã được sử dụng, vui lòng chọn email khác.',
            'The email field format is invalid' => 'Email của bạn không hợp lệ.',
            'The so dien thoai field must be at least 10 characters' => 'Số điện thoại phải có ít nhất 10 số.',
            'The so dien thoai field must not be greater than 10 characters' => 'Số điện thoại không được dài quá 10 số.',
            'The mat khau field must be at least 8 characters' => 'Mật khẩu của bạn phải có ít nhất 8 ký tự.',
            'The mat khau field must not be greater than 20 characters' => 'Mật khẩu của bạn không được vượt quá 20 ký tự.',
        ];

        foreach ($errorMap as $key => $value) {
            if (Str::contains($message, $key)) {
                return $value;
            }
        }

        return 'Có lỗi xảy ra, vui lòng thử lại!';
    }

    /**
     * Update user profile
     * 
     * @param Request $request
     * @return void
     */
    private function updateProfile(Request $request): void
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'so_dien_thoai' => 'nullable|string|max:15',
        ]);

        /** @var NguoiDung $user */
        $user = Auth::user();
        $user->ho_ten = $request->ho_ten;
        $user->email = $request->email;
        $user->so_dien_thoai = $request->so_dien_thoai;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();
    }

    /**
     * Handle password change
     * 
     * @param Request $request
     * @return true|array Returns true on success, error array on failure
     */
    private function handlePasswordChange(Request $request)
    {
        $request->validate([
            'mat_khau_cu' => 'required|string',
            'mat_khau_moi' => 'required|string|min:8|max:20|confirmed',
        ]);

        /** @var NguoiDung $user */
        $user = Auth::user();

        try {
            $currentPassword = Crypt::decrypt($user->mat_khau);
        } catch (\Exception $e) {
            return ['mat_khau_cu' => 'Không thể xác thực mật khẩu hiện tại.'];
        }

        if ($request->mat_khau_cu !== $currentPassword) {
            return ['mat_khau_cu' => 'Mật khẩu cũ không chính xác.'];
        }

        if ($request->mat_khau_moi === $currentPassword) {
            return ['mat_khau_moi' => 'Mật khẩu mới không được trùng với mật khẩu cũ.'];
        }

        $user->mat_khau = Crypt::encrypt($request->mat_khau_moi);
        $user->save();

        return true;
    }
}

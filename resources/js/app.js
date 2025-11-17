import './bootstrap';
import Alpine from 'alpinejs';

const THEME_KEY = 'tt_theme';
const DARK_KEY = 'tt_dark';
const LANGUAGE_KEY = 'tt_language';
const root = document.documentElement;

const storedTheme = localStorage.getItem(THEME_KEY);
const storedDark = localStorage.getItem(DARK_KEY);
const storedLanguage = localStorage.getItem(LANGUAGE_KEY);

const initialTheme = storedTheme ?? 'tropical';
const initialDark = storedDark === '1';
const initialLanguage = storedLanguage ?? 'vi';

const applyTheme = (theme, isDark) => {
    root.setAttribute('data-theme', theme);
    if (isDark) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
};

applyTheme(initialTheme, initialDark);
root.setAttribute('lang', initialLanguage);

// Language translations
const translations = {
    vi: {
        // Navigation & Header
        theme_label: 'Chủ đề',
        tropical: 'Tropical',
        minimal_bw: 'Tối giản',
        pastel: 'Pastel',
        dark_mode: 'Chế độ tối',
        light_mode: 'Chế độ sáng',
        language: 'Ngôn ngữ',
        book_now: 'Đặt ngay',
        book_tour_now: 'Đặt tour ngay',
        login: 'Đăng nhập',
        register: 'Đăng ký',
        logout: 'Đăng xuất',
        booking_history: 'Lịch sử đặt tour',
        personal_info: 'Thông tin cá nhân',
        
        // Header icons & tooltips
        close_menu: 'Đóng menu',
        toggle_dark_mode: 'Đổi chế độ sáng tối',
        company_name: 'Hanoitourist',
        company_tagline: 'Trải nghiệm du lịch cảm hứng nhiệt đới',
        
        // Search & Filter
        where_to_go: 'Bạn muốn đi đâu?',
        search_destination: 'Tìm kiếm điểm đến, tour hoặc trải nghiệm',
        departure_date: 'Ngày khởi hành',
        end_date: 'Ngày kết thúc',
        search: 'Tìm kiếm',
        filters: 'Bộ lọc',
        tour_matching_tours: 'Có :count tour phù hợp',
        tour_experience_types: ':count loại hình trải nghiệm',
        tour_go_to_filters: 'Tới bộ lọc',
        tour_filters_title: 'Bộ lọc tìm kiếm',
        tour_filters_description: 'Tùy chỉnh tiêu chí để tìm tour đúng nhu cầu của bạn.',
        tour_category_label: 'Loại hình du lịch',
        tour_name_label: 'Tên tour du lịch',
        tour_name_placeholder: 'Ví dụ: Phú Quốc 4N3D',
        tour_min_price_label: 'Giá tối thiểu',
        tour_min_price_placeholder: 'Từ',
        tour_max_price_label: 'Giá tối đa',
        tour_max_price_placeholder: 'Đến',
        tour_duration_label: 'Thời gian tour',
        tour_duration_placeholder: 'Ví dụ: 3N2D',
        tour_apply_filters: 'Áp dụng bộ lọc',
        tour_reset_filters: 'Xóa',
        tour_list_title: 'Danh sách tour',
        tour_list_description: 'Hiển thị :count kết quả theo tiêu chí hiện tại.',
        tour_reload_button: 'Tải lại tất cả tour',
        tour_no_results_title: 'Chưa tìm thấy tour phù hợp',
        tour_no_results_description: 'Hãy thử điều chỉnh bộ lọc hoặc liên hệ đội ngũ tư vấn để được gợi ý hành trình riêng.',
        tour_card_description: 'Thời gian :duration với lịch trình cân bằng giữa nghỉ dưỡng và khám phá.',
        tour_card_flexible: 'Hành trình linh hoạt',
        tour_card_view_details: 'Xem chi tiết →',
        
        // Homepage
        home_hero_badge: 'Trải nghiệm nhiệt đới sống động',
        home_hero_title: 'Khám phá hành trình mơ ước cùng Hanoitourist',
        home_hero_description: 'Từ biển xanh nắng vàng đến cao nguyên lộng gió, chúng tôi chọn lọc những hành trình đặc sắc nhất để bạn tận hưởng kỳ nghỉ trọn vẹn, an toàn và giàu cảm hứng.',
        home_hero_explore_tours: 'Khám phá tour',
        home_hero_read_news: 'Đọc tin nổi bật',
        home_search_title: 'Tìm tour phù hợp',
        home_search_description: 'Lọc theo điểm đến, thời gian hoặc ngân sách để lên kế hoạch nhanh chóng.',
        home_search_budget_label: 'Ngân sách tối đa (VNĐ)',
        home_search_budget_placeholder: 'Ví dụ: 10000000',
        home_search_featured_only: 'Chỉ hiển thị tour nổi bật',
        home_search_refine_hint: 'Bạn có thể tinh chỉnh thêm sau khi xem kết quả.',
        home_search_button: 'Tìm tour ngay',
        home_search_clear: 'Xóa lọc',
        home_popular_section_badge: 'Tour du lịch',
        home_popular_section_title: 'Gợi ý hành trình đáng nhớ',
        home_popular_section_description: 'Những hành trình được yêu thích nhất với lịch trình tinh gọn, dịch vụ tận tâm và trải nghiệm bản địa đặc sắc.',
        home_no_tours_title: 'Chưa có tour khả dụng',
        home_no_tours_description: 'Vui lòng quay lại sau hoặc thử tìm kiếm với tiêu chí khác.',
        home_tour_itinerary: 'Lịch trình :duration với nhiều hoạt động địa phương và tiện nghi nghỉ dưỡng chuẩn quốc tế.',
        home_tour_flexible: 'Khởi hành linh hoạt',
        home_view_more_tours: 'Xem thêm tour',
        home_value_badge: 'Giá trị cốt lõi',
        home_value_service_title: 'Dịch vụ chuyên sâu',
        home_value_service_description: 'Đội ngũ tư vấn tận tâm hỗ trợ bạn đặt tour, chọn phòng, đặt vé máy bay và thiết kế lịch trình riêng.',
        home_value_transparency_title: 'Chi phí minh bạch',
        home_value_transparency_description: 'Cam kết không phát sinh chi phí ẩn, nhiều ưu đãi sớm và chương trình tri ân khách hàng thân thiết.',
        home_value_safety_title: 'Đảm bảo an toàn',
        home_value_safety_description: 'Bảo hiểm du lịch toàn diện, đối tác vận chuyển kiểm định định kỳ và hướng dẫn viên giàu kinh nghiệm.',
        home_value_support_title: 'Hỗ trợ 24/7',
        home_value_support_description: 'Đường dây nóng xử lý sự cố ngay lập tức cùng ứng dụng theo dõi lịch trình khi bạn đang trên đường.',
        home_team_badge: 'Chúng tôi là Hanoitourist',
        home_team_title: '20+ năm dẫn lối cho hàng trăm nghìn lượt khách khám phá Việt Nam',
        home_team_description: 'Sự hài lòng của bạn là động lực để chúng tôi không ngừng cải tiến dịch vụ và mở rộng điểm đến mới.',
        home_news_badge: 'Tin tức',
        home_news_title: 'Cập nhật mới nhất từ hành trình',
        home_news_description: 'Khám phá kinh nghiệm du lịch, gợi ý điểm đến theo mùa và thông tin ưu đãi để bạn luôn dẫn đầu xu hướng dịch chuyển.',
        home_news_views: 'lượt xem',
        home_news_empty_title: 'Chưa có tin tức',
        home_news_empty_description: 'Hãy quay lại sau để cập nhật những câu chuyện hành trình mới nhất.',
        home_read_more: 'Đọc tiếp',
        home_view_all_articles: 'Xem tất cả bài viết',
        
        // Navigation menu items
        nav_home: 'Trang chủ',
        nav_tours: 'Tour du lịch',
        nav_news: 'Tin tức',
        nav_about: 'Về chúng tôi',
        
        // Tour detail page
        tour_detail_badge: 'Tour đặc sắc',
        tour_detail_departure: 'Khởi hành',
        tour_detail_duration: 'Thời gian',
        tour_detail_price_from: 'Giá chỉ từ',
        tour_detail_price_includes: 'Giá đã bao gồm vé máy bay khứ hồi, khách sạn chuẩn 4 sao và lịch trình trải nghiệm địa phương.',
        tour_detail_book_now: 'Đặt tour ngay',
        tour_detail_view_itinerary: 'Xem lịch trình',
        tour_detail_intro_title: 'Giới thiệu hành trình',
        tour_detail_intro_description: 'Thông tin chi tiết về tour được cập nhật mới nhất để bạn dễ dàng lên kế hoạch.',
        tour_detail_highlights_title: 'Điểm nổi bật',
        tour_detail_highlight_1: 'Lịch trình cân bằng giữa thư giãn và khám phá địa phương.',
        tour_detail_highlight_2: 'Hướng dẫn viên tận tâm đồng hành xuyên suốt chuyến đi.',
        tour_detail_highlight_3: 'Bữa ăn tiêu chuẩn cao với thực đơn địa phương đặc sắc.',
        tour_detail_highlight_4: 'Dịch vụ hỗ trợ 24/7 trong suốt hành trình.',
        tour_detail_booking_title: 'Đặt tour',
        tour_detail_booking_description: 'Nhập thông tin cơ bản. Đội ngũ của chúng tôi sẽ liên hệ xác nhận trong vòng 24 giờ.',
        tour_detail_full_name: 'Họ và tên',
        tour_detail_full_name_placeholder: 'Tên của bạn',
        tour_detail_email: 'Email',
        tour_detail_email_placeholder: 'you@example.com',
        tour_detail_phone: 'Số điện thoại',
        tour_detail_phone_placeholder: '0987 654 321',
        tour_detail_people_count: 'Số người',
        tour_detail_departure_date: 'Ngày khởi hành',
        tour_detail_unit_price: 'Đơn giá',
        tour_detail_total_price: 'Tổng giá',
        tour_detail_submit_booking: 'Gửi yêu cầu đặt tour',
        tour_detail_commitment_title: 'Cam kết của Hanoitourist',
        tour_detail_commitment_1: 'Hoàn tiền 100% nếu tour không khởi hành như cam kết.',
        tour_detail_commitment_2: 'Hỗ trợ thay đổi lịch trình miễn phí trước 7 ngày.',
        tour_detail_commitment_3: 'Ưu đãi giảm đến 10% cho khách hàng thân thiết.',
        tour_detail_related_badge: 'Gợi ý khác',
        tour_detail_related_title: 'Những hành trình bạn có thể thích',
        tour_detail_related_description: 'Chọn thêm hành trình dự phòng hoặc gợi ý cho bạn bè cùng trải nghiệm.',
        tour_detail_no_related_title: 'Chưa có tour gợi ý',
        tour_detail_no_related_description: 'Vui lòng quay lại sau để xem thêm các lựa chọn khác.',
        tour_detail_related_duration: 'Thời gian :duration với hoạt động trải nghiệm địa phương độc đáo.',
        tour_detail_related_promo: 'Ưu đãi mùa này',
        
        // News listing page
        news_listing_badge: 'Hanoitourist',
        news_listing_hero_title: 'Tin tức du lịch mới nhất',
        news_listing_hero_description: 'Cập nhật xu hướng điểm đến, kinh nghiệm hành trình và ưu đãi hấp dẫn để bạn luôn dẫn đầu xu hướng dịch chuyển.',
        news_listing_showing: ':count bài viết đang hiển thị',
        news_listing_categories: ':count chủ đề du lịch',
        news_listing_explore_filters: 'Khám phá bộ lọc',
        news_listing_filter_title: 'Lọc theo thể loại',
        news_listing_filter_description: 'Chọn chủ đề bạn quan tâm để xem bài viết phù hợp.',
        news_listing_apply: 'Áp dụng',
        news_listing_reset: 'Bỏ chọn',
        news_listing_featured_title: 'Tin tức nổi bật',
        news_listing_featured_description: 'Cập nhật những câu chuyện được quan tâm nhiều nhất trong tuần.',
        news_listing_empty_title: 'Chưa có bài viết phù hợp',
        news_listing_empty_description: 'Hãy thử điều chỉnh bộ lọc hoặc quay lại sau để xem thêm bài viết mới.',
        
        // Tour listings
        duration: 'Thời gian',
        price: 'Giá',
        rating: 'Đánh giá',
        views: 'lượt xem',
        departure_from: 'Khởi hành từ',
        days: 'ngày',
        per_person: 'người',
        vnd: 'VNĐ',
        
        // Buttons
        view_details: 'Xem chi tiết',
        book_this_tour: 'Đặt tour này',
        cancel: 'Hủy',
        confirm: 'Xác nhận',
        save: 'Lưu',
        delete: 'Xóa',
        
        // Home page
        your_trusted_companion: 'Bạn đồng hành đáng tin cậy trên mỗi hành trình',
        we_carefully_survey: 'Chúng tôi dành thời gian khảo sát từng điểm đến, xây dựng lịch trình thông minh và lựa chọn đối tác uy tín để mỗi chuyến đi đều là trải nghiệm đáng nhớ.',
        in_depth_service: 'Dịch vụ chuyên sâu',
        dedicated_team: 'Đội ngũ tư vấn tận tâm hỗ trợ bạn đặt tour, chọn phòng, đặt vé máy bay và thiết kế lịch trình riêng.',
        transparent_pricing: 'Chi phí minh bạch',
        no_hidden_charges: 'Cam kết không phát sinh chi phí ẩn, nhiều ưu đãi sớm và chương trình tri ân khách hàng thân thiết.',
        safety_assurance: 'Đảm bảo an toàn',
        we_commit_to_safety: 'Cam kết an toàn tối đa cho khách hàng với các tiêu chuẩn quốc tế và bảo hiểm toàn diện.',
        
        // Blog & News
        hanoitourist_blog: 'Hanoitourist Blog',
        published_date: 'Ngày đăng',
        share_article: 'Chia sẻ bài viết',
        inspire_your_friends: 'Lan tỏa cảm hứng du lịch đến bạn bè của bạn.',
        facebook: 'Facebook',
        zalo: 'Zalo',
        email: 'Email',
        
        // Footer
        cancel_policy: 'Chính sách hủy tour',
        payment_guide: 'Hướng dẫn thanh toán',
        contact_us: 'Liên hệ chúng tôi',
        newsletter_signup: 'Đăng ký nhận tin',
        latest_offers: 'Nhận ưu đãi tour mới nhất và gợi ý hành trình dành riêng cho bạn.',
        all_rights_reserved: 'Giữ tất cả quyền',
        
        // Account sidebar
        account: 'Tài khoản',
        account_settings: 'Cài đặt cá nhân',
        manage_profile: 'Quản lý thông tin hồ sơ và bảo mật đăng nhập của bạn.',
        profile: 'Hồ sơ',
        change_password: 'Đổi mật khẩu',
        
        // Booking history
        booking_history_title: 'Lịch sử đặt tour',
        track_all_bookings: 'Theo dõi tất cả booking của bạn và chủ động quản lý lịch trình.',
        status: 'Trạng thái',
        tour_name: 'Tên tour',
        customer_name: 'Họ tên',
        phone: 'Điện thoại',
        number_of_people: 'Số người',
        departure_day: 'Ngày đi',
        total_amount: 'Tổng tiền',
        actions: 'Hành động',
        confirmed: 'Đã Xác Nhận',
        processing: 'Đang Xử Lý',
        pending: 'Chờ xác nhận',
        cancelled: 'Đã Hủy',
        
        // About page
        awards: 'Giải thưởng',
        top_ten_agencies: 'Top Ten lữ hành quốc tế',
        vietnam_airlines_partner: 'Đối tác chiến lược Vietnam Airlines',
        vision: 'Tầm nhìn',
        mission: 'Sứ mệnh',
        our_vision: 'Trở thành thương hiệu lữ hành đáng tin cậy nhất tại Việt Nam, gắn liền với dịch vụ đẳng cấp và trải nghiệm cảm xúc.',
        our_mission: 'Kiến tạo hành trình chuẩn mực, giàu trải nghiệm bản địa, góp phần nâng tầm thương hiệu du lịch Việt Nam trên bản đồ thế giới.',
        
        // Common
        address: 'Địa chỉ',
        phone_number: 'Số điện thoại',
        email_address: 'Email',
        username: 'Tài khoản',
        role: 'Vai trò',
        password: 'Mật khẩu',
        confirm_password: 'Xác nhận mật khẩu',
        no_data: 'Không có dữ liệu',
        loading: 'Đang tải...',
        error: 'Lỗi',
        success: 'Thành công',
    },
    en: {
        // Navigation & Header
        theme_label: 'Theme',
        tropical: 'Tropical',
        minimal_bw: 'Minimal',
        pastel: 'Pastel',
        dark_mode: 'Dark Mode',
        light_mode: 'Light Mode',
        language: 'Language',
        book_now: 'Book Now',
        book_tour_now: 'Book Tour Now',
        login: 'Login',
        register: 'Sign Up',
        logout: 'Logout',
        booking_history: 'Booking History',
        personal_info: 'Personal Information',
        
        // Header icons & tooltips
        close_menu: 'Close Menu',
        toggle_dark_mode: 'Toggle Dark Mode',
        company_name: 'Hanoitourist',
        company_tagline: 'Tropical Vacation Experience',
        
        // Search & Filter
        where_to_go: 'Where would you like to go?',
        search_destination: 'Search destinations, tours or experiences',
        departure_date: 'Departure Date',
        end_date: 'End Date',
        search: 'Search',
        filters: 'Filters',
        tour_matching_tours: ':count matching tours',
        tour_experience_types: ':count experience types',
        tour_go_to_filters: 'Go to filters',
        tour_filters_title: 'Search Filters',
        tour_filters_description: 'Adjust the criteria to find the tour that fits your needs.',
        tour_category_label: 'Tour categories',
        tour_name_label: 'Tour name',
        tour_name_placeholder: 'Example: Phu Quoc 4D3N',
        tour_min_price_label: 'Minimum price',
        tour_min_price_placeholder: 'From',
        tour_max_price_label: 'Maximum price',
        tour_max_price_placeholder: 'To',
        tour_duration_label: 'Tour duration',
        tour_duration_placeholder: 'Example: 3D2N',
        tour_apply_filters: 'Apply filters',
        tour_reset_filters: 'Clear',
        tour_list_title: 'Tour list',
        tour_list_description: 'Showing :count results based on the current criteria.',
        tour_reload_button: 'Reload all tours',
        tour_no_results_title: 'No matching tours found',
        tour_no_results_description: 'Try adjusting the filters or contact our consultants for a tailor-made itinerary.',
        tour_card_description: 'Duration :duration with a balanced itinerary between relaxation and exploration.',
        tour_card_flexible: 'Flexible itinerary',
        tour_card_view_details: 'View details →',
        
        // Homepage
        home_hero_badge: 'Vibrant Tropical Experience',
        home_hero_title: 'Discover Your Dream Journey with Hanoitourist',
        home_hero_description: 'From sun-kissed beaches to breezy highlands, we curate the most distinctive itineraries for you to enjoy a complete, safe, and inspiring vacation.',
        home_hero_explore_tours: 'Explore Tours',
        home_hero_read_news: 'Read Featured News',
        home_search_title: 'Find the Right Tour',
        home_search_description: 'Filter by destination, time, or budget to plan quickly.',
        home_search_budget_label: 'Maximum budget (VND)',
        home_search_budget_placeholder: 'Example: 10000000',
        home_search_featured_only: 'Show featured tours only',
        home_search_refine_hint: 'You can refine further after viewing results.',
        home_search_button: 'Search Tours Now',
        home_search_clear: 'Clear Filters',
        home_popular_section_badge: 'Travel Tours',
        home_popular_section_title: 'Memorable Journey Suggestions',
        home_popular_section_description: 'The most popular itineraries with concise schedules, dedicated services, and distinctive local experiences.',
        home_no_tours_title: 'No tours available',
        home_no_tours_description: 'Please come back later or try searching with different criteria.',
        home_tour_itinerary: 'Itinerary :duration with many local activities and international-standard resort amenities.',
        home_tour_flexible: 'Flexible departure',
        home_view_more_tours: 'View More Tours',
        home_value_badge: 'Core Values',
        home_value_service_title: 'In-Depth Service',
        home_value_service_description: 'Our dedicated advisory team helps you book tours, choose hotels, purchase flight tickets and design personalized itineraries.',
        home_value_transparency_title: 'Transparent Pricing',
        home_value_transparency_description: 'We guarantee no hidden fees, offer early-bird discounts and provide loyalty rewards for our valued customers.',
        home_value_safety_title: 'Safety Assurance',
        home_value_safety_description: 'Comprehensive travel insurance, periodically inspected transport partners, and experienced tour guides.',
        home_value_support_title: '24/7 Support',
        home_value_support_description: 'Hotline for immediate incident resolution along with an itinerary tracking app while you\'re on the road.',
        home_team_badge: 'We are Hanoitourist',
        home_team_title: '20+ years guiding hundreds of thousands of travelers to discover Vietnam',
        home_team_description: 'Your satisfaction is the motivation for us to continuously improve our services and expand to new destinations.',
        home_news_badge: 'News',
        home_news_title: 'Latest Updates from the Journey',
        home_news_description: 'Discover travel experiences, seasonal destination suggestions, and promotional information to stay ahead of travel trends.',
        home_news_views: 'views',
        home_news_empty_title: 'No news yet',
        home_news_empty_description: 'Come back later for updates on the latest travel stories.',
        home_read_more: 'Read More',
        home_view_all_articles: 'View All Articles',
        
        // Tour detail page
        tour_detail_badge: 'Featured Tour',
        tour_detail_departure: 'Departure',
        tour_detail_duration: 'Duration',
        tour_detail_price_from: 'Starting from',
        tour_detail_price_includes: 'Price includes round-trip airfare, 4-star hotel accommodation, and local experience itinerary.',
        tour_detail_book_now: 'Book Now',
        tour_detail_view_itinerary: 'View Itinerary',
        tour_detail_intro_title: 'Journey Overview',
        tour_detail_intro_description: 'Detailed tour information updated for easy planning.',
        tour_detail_highlights_title: 'Highlights',
        tour_detail_highlight_1: 'Balanced itinerary between relaxation and local exploration.',
        tour_detail_highlight_2: 'Dedicated tour guide accompanying throughout the trip.',
        tour_detail_highlight_3: 'High-quality meals with distinctive local menu.',
        tour_detail_highlight_4: '24/7 support service throughout the journey.',
        tour_detail_booking_title: 'Book Tour',
        tour_detail_booking_description: 'Enter basic information. Our team will contact you for confirmation within 24 hours.',
        tour_detail_full_name: 'Full Name',
        tour_detail_full_name_placeholder: 'Your name',
        tour_detail_email: 'Email',
        tour_detail_email_placeholder: 'you@example.com',
        tour_detail_phone: 'Phone Number',
        tour_detail_phone_placeholder: '0987 654 321',
        tour_detail_people_count: 'Number of People',
        tour_detail_departure_date: 'Departure Date',
        tour_detail_unit_price: 'Unit Price',
        tour_detail_total_price: 'Total Price',
        tour_detail_submit_booking: 'Submit Booking Request',
        tour_detail_commitment_title: 'Hanoitourist Commitment',
        tour_detail_commitment_1: '100% refund if tour does not depart as committed.',
        tour_detail_commitment_2: 'Free itinerary change support 7 days in advance.',
        tour_detail_commitment_3: 'Up to 10% discount for loyal customers.',
        tour_detail_related_badge: 'Other Suggestions',
        tour_detail_related_title: 'Journeys You Might Like',
        tour_detail_related_description: 'Choose additional backup journeys or recommend to friends to experience together.',
        tour_detail_no_related_title: 'No suggested tours',
        tour_detail_no_related_description: 'Please come back later to see more options.',
        tour_detail_related_duration: 'Duration :duration with unique local experience activities.',
        tour_detail_related_promo: 'Seasonal offer',
        
        // News listing page
        news_listing_badge: 'Hanoitourist',
        news_listing_hero_title: 'Latest Travel News',
        news_listing_hero_description: 'Stay updated on destination trends, travel experiences, and attractive offers to lead travel trends.',
        news_listing_showing: ':count articles showing',
        news_listing_categories: ':count travel topics',
        news_listing_explore_filters: 'Explore filters',
        news_listing_filter_title: 'Filter by Category',
        news_listing_filter_description: 'Choose topics you\'re interested in to see relevant articles.',
        news_listing_apply: 'Apply',
        news_listing_reset: 'Clear',
        news_listing_featured_title: 'Featured News',
        news_listing_featured_description: 'The most popular stories this week.',
        news_listing_empty_title: 'No matching articles',
        news_listing_empty_description: 'Try adjusting the filters or come back later to see new articles.',
        
        // Navigation menu items
        nav_home: 'Home',
        nav_tours: 'Tours',
        nav_news: 'News',
        nav_about: 'About Us',
        
        // Tour listings
        duration: 'Duration',
        price: 'Price',
        rating: 'Rating',
        views: 'views',
        departure_from: 'Departing from',
        days: 'days',
        per_person: 'person',
        vnd: 'VND',
        
        // Buttons
        view_details: 'View Details',
        book_this_tour: 'Book This Tour',
        cancel: 'Cancel',
        confirm: 'Confirm',
        save: 'Save',
        delete: 'Delete',
        
        // Home page
        your_trusted_companion: 'Your Trusted Companion on Every Journey',
        we_carefully_survey: 'We carefully survey each destination, craft smart itineraries and select trusted partners to ensure every trip is an unforgettable experience.',
        in_depth_service: 'In-Depth Service',
        dedicated_team: 'Our dedicated advisory team helps you book tours, choose hotels, purchase flight tickets and design personalized itineraries.',
        transparent_pricing: 'Transparent Pricing',
        no_hidden_charges: 'We guarantee no hidden fees, offer early-bird discounts and provide loyalty rewards for our valued customers.',
        safety_assurance: 'Safety Assurance',
        we_commit_to_safety: 'We are committed to your safety with international standards and comprehensive travel insurance.',
        
        // Blog & News
        hanoitourist_blog: 'Hanoitourist Blog',
        published_date: 'Published',
        share_article: 'Share Article',
        inspire_your_friends: 'Inspire your friends with travel inspiration.',
        facebook: 'Facebook',
        zalo: 'Zalo',
        email: 'Email',
        
        // Footer
        cancel_policy: 'Cancellation Policy',
        payment_guide: 'Payment Guide',
        contact_us: 'Contact Us',
        newsletter_signup: 'Newsletter Signup',
        latest_offers: 'Get the latest tour offers and personalized travel recommendations.',
        all_rights_reserved: 'All rights reserved',
        
        // Account sidebar
        account: 'Account',
        account_settings: 'Account Settings',
        manage_profile: 'Manage your profile information and login security.',
        profile: 'Profile',
        change_password: 'Change Password',
        
        // Booking history
        booking_history_title: 'Booking History',
        track_all_bookings: 'Track all your bookings and proactively manage your itineraries.',
        status: 'Status',
        tour_name: 'Tour Name',
        customer_name: 'Full Name',
        phone: 'Phone',
        number_of_people: 'Number of People',
        departure_day: 'Departure Day',
        total_amount: 'Total Amount',
        actions: 'Actions',
        confirmed: 'Confirmed',
        processing: 'Processing',
        pending: 'Pending',
        cancelled: 'Cancelled',
        
        // About page
        awards: 'Awards',
        top_ten_agencies: 'Top Ten International Travel Agencies',
        vietnam_airlines_partner: 'Vietnam Airlines Strategic Partner',
        vision: 'Vision',
        mission: 'Mission',
        our_vision: 'To become the most trusted travel brand in Vietnam, known for premium services and emotional experiences.',
        our_mission: 'Create exceptional itineraries rich in local experiences, elevating Vietnam\'s tourism brand on the world map.',
        
        // Common
        address: 'Address',
        phone_number: 'Phone Number',
        email_address: 'Email',
        username: 'Username',
        role: 'Role',
        password: 'Password',
        confirm_password: 'Confirm Password',
        no_data: 'No Data',
        loading: 'Loading...',
        error: 'Error',
        success: 'Success',
    },
};

document.addEventListener('alpine:init', () => {
    Alpine.store('uiTheme', {
        theme: initialTheme,
        dark: initialDark,
        language: initialLanguage,
        setTheme(theme) {
            this.theme = theme;
            localStorage.setItem(THEME_KEY, theme);
            applyTheme(this.theme, this.dark);
        },
        setDark(value) {
            this.dark = Boolean(value);
            localStorage.setItem(DARK_KEY, this.dark ? '1' : '0');
            applyTheme(this.theme, this.dark);
        },
        toggleDark() {
            this.setDark(!this.dark);
        },
        setLanguage(lang) {
            this.language = lang;
            localStorage.setItem(LANGUAGE_KEY, lang);
            root.setAttribute('lang', lang);
            // Reload page to apply language changes
            window.location.reload();
        },
        t(key) {
            return translations[this.language]?.[key] ?? translations.en[key];
        },
        format(key, replacements = {}) {
            const template = this.t(key) ?? '';
            return Object.keys(replacements).reduce((carry, placeholder) => {
                const value = replacements[placeholder];
                const escaped = placeholder.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                return carry.replace(new RegExp(`:${escaped}`, 'g'), value);
            }, template);
        },
    });
});

window.Alpine = Alpine;
Alpine.start();

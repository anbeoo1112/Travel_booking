import './bootstrap';
import Alpine from 'alpinejs';

const THEME_KEY = 'tt_theme';
const DARK_KEY = 'tt_dark';
const root = document.documentElement;

const storedTheme = localStorage.getItem(THEME_KEY);
const storedDark = localStorage.getItem(DARK_KEY);

const initialTheme = storedTheme ?? 'tropical';
const initialDark = storedDark === '1';

const applyTheme = (theme, isDark) => {
    root.setAttribute('data-theme', theme);
    if (isDark) {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
};

applyTheme(initialTheme, initialDark);

document.addEventListener('alpine:init', () => {
    Alpine.store('uiTheme', {
        theme: initialTheme,
        dark: initialDark,
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
    });
});

window.Alpine = Alpine;
Alpine.start();

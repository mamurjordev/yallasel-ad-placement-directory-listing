const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    purge: {
        enabled: false,
        content: [
            "./vendor/laravel/jetstream/**/*.blade.php",
            "./storage/framework/views/*.php",
            "./resources/views/**/*.blade.php",
            "./resources/js/**/*.vue"
        ]
    },
    // purge: [
    //     './vendor/laravel/jetstream/**/*.blade.php',
    //     './storage/framework/views/*.php',
    //     './resources/views/**/*.blade.php',
    //     './resources/js/**/*.vue',
    // ],

    theme: {
        extend: {
            fontSize: {
                "2xs": ".65rem"
            },
            fontFamily: {
                sans: ["ui-sans-serif"],
                roboto: ["Roboto", ...defaultTheme.fontFamily.sans],
                tajawal: ["Tajawal", ...defaultTheme.fontFamily.sans],
                notosans: ["Noto Sans KR", ...defaultTheme.fontFamily.sans]
            },
            textColor: {
                primary: "#4182C3",
                text2: "#1F3E2B"
            },
            container: false,
            backgroundImage: {
                "hero-bg": "url('/media/site/hero_bg.jpg')",
                "footer-border": "url('/media/site/footer-border.svg')",
                "login-bg": "url('/media/site/login_background.svg')",
                string: "url('/media/site/svg/string.svg')"
            },
            backgroundColor: {
                btn: "#4182C3",
                bg2: "#49b975",
                "3": "#f9f7f6",
                bg4: "#137EEC",
                search: "#4182c3",
                tp1: "#0101018a"
            },
            borderColor: {
                "1": "#137EEC"
            },
            maxHeight: {
                120: "30rem"
            }
        }
    },

    variants: {
        extend: {
            // opacity: ["disabled"]
            display: ["group-hover"]
        }
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("tailwindcss-rtl"),
        function({ addComponents }) {
            addComponents({
                ".container": {
                    maxWidth: "100%",
                    "@screen sm": {
                        maxWidth: "600px"
                    },
                    "@screen md": {
                        maxWidth: "768px"
                    },
                    "@screen lg": {
                        maxWidth: "992px"
                    },
                    "@screen xl": {
                        maxWidth: "1200px"
                    }
                }
            });
        }
    ]
};

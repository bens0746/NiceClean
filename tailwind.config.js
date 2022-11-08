module.exports = {
  content: ["./*.html", "./*.php", "./assets/**/*.js","./node_modules/flowbite/**/*.js"],

  theme: {
    screens: {
      'xs': '375px',
      // => @media (min-width: 375px) { ... }

      'sm': '576px',
      // => @media (min-width: 576px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '992px',
      // => @media (min-width: 992px) { ... }

      'xl': '1200px',
      // => @media (min-width: 1200px) { ... }

      '2xl': '1400px',
      // => @media (min-width: 1400px) { ... }
    },
    container: {
      center: true,
      padding: "16px",
    },
    extend: {
      colors: {
        black: "#212b36",
        dark: "#090E34",
        "dark-700": "#090e34b3",
        primary: "#3398FF",
        secondary: "#13C296",
        "body-color": "#637381",
        warning: "#FBBF24",
      },
      boxShadow: {
        input: "0px 7px 20px rgba(0, 0, 0, 0.03)",
        pricing: "0px 39px 23px -27px rgba(0, 0, 0, 0.04)",
        "switch-1": "0px 0px 5px rgba(0, 0, 0, 0.15)",
        testimonial: "0px 60px 120px -20px #EBEFFD",
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
};

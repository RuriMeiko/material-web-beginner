<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Rounded" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
<script type="importmap">
    {
        "imports": {
            "@material/web/": "https://esm.run/@material/web/"
        }
    }
</script>
<script type="module">
    import "@material/web/all.js";
    import {
        styles as typescaleStyles
    } from "@material/web/typography/md-typescale-styles.js";

    document.adoptedStyleSheets.push(typescaleStyles.styleSheet);
</script>

<script src="/public/js/global.js"></script>
<link rel="stylesheet" href="/public/css/global.css" />
<script src="https://unpkg.com/@popperjs/core@2"></script>

<script src="https://unpkg.com/tippy.js@6"></script>
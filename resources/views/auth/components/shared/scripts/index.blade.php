<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="/dashboard/src/js/vendor/jquery-3.3.1.min.js"><\/script>')
</script>
<script src="/dashboard/plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="/dashboard/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/dashboard/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
<script src="/dashboard/plugins/screenfull/dist/screenfull.js"></script>
<script src="/dashboard/dist/js/theme.js"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = 'https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
@livewireScripts

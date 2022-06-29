<script type="text/javascript">
    // demos.js

    var clipboardDemos = new Clipboard('[data-clipboard-demo]');

    clipboardDemos.on('success', function (e) {
        e.clearSelection();

        console.info('Action:', e.action);
        console.info('Text:', e.text);
        console.info('Trigger:', e.trigger);

        showTooltip(e.trigger, 'Copied!');
    });

    clipboardDemos.on('error', function (e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);

        showTooltip(e.trigger, fallbackMessage(e.action));
    });

    // tooltips.js

    var btns = document.querySelectorAll('.tooltip-btn');

    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener('mouseleave', clearTooltip);
        btns[i].addEventListener('blur', clearTooltip);
    }

    function showTooltip(elem, msg) {
        elem.setAttribute('class', 'input-group-text tooltipped tooltipped-s cursor-pointer');
        elem.setAttribute('aria-label', msg);
    }

</script>
<script>
    function shareUserDetails(phone_no) {
        setShareLinks(phone_no);
    }
</script>
<script type="text/javascript">
    window.onload = setShareLinks;

    function setShareLinks(phone_no) {
        var domain = window.location.origin;
        var pageUrl = "Reset Your Password to Login: " + domain + "/reset-password/" + phone_no;
        var pageTitle = '';
        console.log(pageUrl);
        document.addEventListener('click', function (event) {
            let url = null;

            if (event.target.classList.contains('share__link--whatsapp')) {
                url = "whatsapp://send?text=" + pageTitle + "%20" + pageUrl;
                socialWindow(url, 570, 450);
            }

            if (event.target.classList.contains('share__link--mail')) {
                url = "mailto:?subject=%22" + pageTitle + "%22&body=Read%20the%20article%20%22" + pageTitle +
                    "%22%20on%20" + pageUrl;
                socialWindow(url, 570, 450);
            }

        }, false);
    }

    function socialWindow(url, width, height) {
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" +
            left;
        window.open(url, "", params);
    }
</script>

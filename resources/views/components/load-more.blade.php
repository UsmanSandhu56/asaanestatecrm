<script type="text/javascript">
    // document.addEventListener('livewire:load', function () {
    //     (function ($) {
    //         $.fn.hasScrollBar = function () {
    //             return this.get(0).scrollHeight > this.height();
    //         }
    //     })(jQuery);

    //     if ($('body').hasScrollBar()) {
    //         window.onscroll = function (ev) {
    //             if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    //                 @this.loadMore()
    //             }
    //         };
    //     } else {
    //        @this.loadMore()
    //     }
    // });

    const lastRecord = document.getElementById('last_record');
    const options = {
        root: null,
        threshold: 1,
        rootMargin: '0px'
    }
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                @this.loadMore()
            }
        });
    });
    observer.observe(lastRecord);

</script>

$(document).ready(function() {
    // $('#profileNav').click(function () {
    //     $('.dropdown', this).toggleClass('hidden');
    // });

    // Mega Menu
    $(".megadropdown").click(function() {
        $("i", this)
            .toggleClass("fa-chevron-down")
            .toggleClass("fa-chevron-up");
        $(".mega-menu").toggleClass("hidden");
        $(".overlay").toggleClass("hidden");
    });

    // Page nav dropdown
    $(".page-nav").click(function() {
        $(".page-nav ul").addClass("hidden");
        $("ul", this).toggleClass("hidden");
    });
});

// Owl Carousel
$(document).ready(function() {
    var owl = $(".owl-carousel");
    owl.owlCarousel({
        items: 1,
        autoplay: true,
        autoplayHoverPause: true
    });
    $(".customNextBtn").click(function() {
        owl.trigger("next.owl.carousel");
    });
    // Go to the previous item
    $(".customPrevBtn").click(function() {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger("prev.owl.carousel", [300]);
    });
});

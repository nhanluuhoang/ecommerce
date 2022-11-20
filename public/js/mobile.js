$(document).ready(function(){
    const siteNav = $("#site-nav--mobile");
    const siteOverlay = $("#site-overlay");
    const openMenu = $("#site-menu-handle");
    openMenu.click(function(){
        openMenu.hasClass("active") ||
        (
            siteNav.addClass("active"),
            siteNav.removeClass("show-filters").removeClass("show-cart").removeClass("show-search"),
            siteOverlay.addClass("active"),
            $(".main-body").addClass("sidebar-move")
        )
    });

    $('.menu-collection .icon-subnav').on('click', function () {
        $(this).next().slideToggle();
        $(this).toggleClass('active_chir_mb');
    });

    $(".site-close-handle, #site-overlay").on("click", function () {
        siteNav.hasClass("active") &&
        (
            siteNav.removeClass("active"),
            siteOverlay.removeClass("active"),
            $(".main-body").removeClass("sidebar-move")
        )
    });


    $("#site-search-handle a, .clickSearch").on("click", function (b) {
        b.preventDefault();
        siteNav.hasClass("active") || (
            siteNav.addClass("active"),
            siteNav.removeClass("show-filters").removeClass("show-cart").addClass("show-search"),
            siteOverlay.addClass("active"),
            $(".main-body").addClass("sidebar-move")
        )
    });


});

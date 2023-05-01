/**
 * @class AdYammy
 */
var AdYammy = (function () {
    var self = this;
    const AD_YOUR_BANNER = 2;

    return {
        config: {
            fileInputImageClass: '.js-file-input-image',
        },

        vars: {},

        init: function () {
            self = this;
            self.initVars();
            self.attachEventListeners();
        },

        initVars: function () {
            self.vars = {
                fileInputImage: $(self.config.fileInputImageClass),
            }
        },

        attachEventListeners: function () {
            self.removeImageListener();
            self.selectCompanyListener();
        },

        selectCompanyListener: function () {
            $(document).ready(function () {
                $('.file-caption-icon').hide();
                var selectedCompanyId = Number($('.js-company-select').val());

                if (selectedCompanyId === AD_YOUR_BANNER) {
                    $('.js-adcode-mobile').hide();
                    $('.js-adcode-desktop').hide();
                    $('.js-banner-scroll-mobile').hide();
                    $('.js-banner-scroll-desktop').hide();
                } else {
                    $('.js-image-desktop').hide();
                    $('.js-image-mobile').hide();
                    $('.js-url').hide();
                }

                $('.js-company-select').on('change', function () {
                    selectedCompanyId = Number($(this).val());

                    if (selectedCompanyId === AD_YOUR_BANNER) {
                        $('.js-adcode-mobile').slideToggle();
                        $('.js-adcode-desktop').slideToggle();
                        $('.js-banner-scroll-mobile').slideToggle();
                        $('.js-banner-scroll-desktop').slideToggle();
                        $('.js-image-mobile').slideToggle();
                        $('.js-image-desktop').slideToggle();
                        $('.js-url').slideToggle();
                    } else {
                        $('.js-image-mobile').slideToggle();
                        $('.js-image-desktop').slideToggle();
                        $('.js-url').slideToggle();
                        $('.js-adcode-mobile').slideToggle();
                        $('.js-adcode-desktop').slideToggle();
                        $('.js-banner-scroll-mobile').slideToggle();
                        $('.js-banner-scroll-desktop').slideToggle();
                    }
                });
            });
        },

        removeImageListener: function () {
            $(document).ready(function () {
                $(self.vars.fileInputImage).fileinput().on('fileclear', function () {
                    const deleteUrl = $(this).data('delete-url');
                    const id = $(this).data('id');

                    $.ajax({
                        type: "POST",
                        url: deleteUrl,
                        data: {
                            id: id
                        },
                        error: function () {
                            alert("При удалении изображения возникла ошибка", "error");
                        }
                    });
                });
            });
        },
    };
})();

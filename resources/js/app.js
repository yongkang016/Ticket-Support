import tinymce from 'tinymce';
import 'tinymce/themes/silver';
import 'tinymce/plugins/table/plugin';
import 'tinymce/icons/default';
import 'tinymce/plugins/wordcount/plugin';
import 'tinymce/plugins/autoresize/plugin';
import 'tinymce/plugins/lists/plugin';
import 'tinymce/skins/ui/oxide/skin.min.css';
import _ from 'lodash';
import CryptoJS from 'crypto-js';
import * as markerjs2 from 'markerjs2';
import { BillboardMarker } from "./markerjs2/billboard";
import { KioskMarker } from "./markerjs2/kiosk";
import { LedStandMarker } from "./markerjs2/led-stand";
import { LightBoxMarker } from "./markerjs2/lightbox";
import { PillarWrappingMarker } from "./markerjs2/pillar-wrapping";
import { PromotionAreaMarker } from "./markerjs2/promotion-area";
import { WallBannerMarker } from "./markerjs2/wall-banner";
import { WallSignMarker } from "./markerjs2/wall-sign";

window._ = _;
window.CryptoJS = CryptoJS;
window.markerjs2 = markerjs2;
window.billboardMarker = BillboardMarker;
window.kioskMarker = KioskMarker;
window.ledStandMarker = LedStandMarker;
window.lightboxMarker = LightBoxMarker;
window.pillarWrappingMarker = PillarWrappingMarker;
window.promotionAreaMarker = PromotionAreaMarker;
window.wallBannerMarker = WallBannerMarker;
window.wallSignMarker = WallSignMarker;

$(document).ready(function () {
    // Start TinyMCE Config
    tinymce.init({
        selector: 'textarea.tinymce-html-editor',
        plugins: 'table lists wordcount',
        height: 530,
        menubar: false,
        toolbar: 'undo redo | fontsizeselect | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table',
        content_css: window.location.origin + '/css/tinymce/content.min.css',
        skin: false,
    });
    // End TinyMCE Config

    // start format select2 options display text
    function tselect2() {
        $('.tselect2').select2({
            templateSelection: function (val) {
                return val.id;
            },
        });
    }
    tselect2();
    // end format select2 options display text

    // start
    let filterButton = $(`.filter-button`)
    let container = $(`.filter-container`)
    let initialHeight = container.outerHeight();
    container.css('height', initialHeight + 'px');
    filterButton.on('click', function () {
        let height = container.outerHeight();
        if (height == 0) {
            container.css('height', 'auto');
            height = container.outerHeight();

            container.css('height', '0');
            if (container.outerHeight() == 0) {
                container.css('height', height + 'px');

                setTimeout(() => {
                    container.css('height', 'auto');
                }, 300)
            }
        } else {
            container.css('height', 'auto');

            height = container.outerHeight();

            container.css('height', height + 'px');

            if (container.outerHeight() > 0) {
                container.css('height', '0');
            }
        }
    })
    // end

    // start submit button debounce
    let searchBtn = $('#search-btn');
    searchBtn.on('click', function () {
        searchBtn.attr('data-kt-indicator', 'on');
        searchBtn.attr('disabled', true);
        $(this).parents('form').submit();
    });
    // end
});

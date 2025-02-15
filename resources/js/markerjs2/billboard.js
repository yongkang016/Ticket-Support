import {ColorPickerPanel, RectangularBoxMarkerBase, SvgHelper} from 'markerjs2';

export class BillboardMarker extends RectangularBoxMarkerBase {
    strokeColor = 'transparent';
    strokeWidth = 0;

    constructor(container, overlayContainer, settings) {
        super(container, overlayContainer, settings);

        this.strokeColor = settings.defaultColor;
        this.strokeWidth = settings.defaultStrokeWidth;

        this.createVisual = this.createVisual.bind(this);
        this.setStrokeColor = this.setStrokeColor.bind(this);

        this.strokePanel = new ColorPickerPanel(
            'line color',
            settings.defaultColorSet,
            settings.defaultColor,
        );

        this.strokePanel.onColorChanged = this.setStrokeColor;
    }

    createVisual() {
        this.visual = SvgHelper.createImage([
            ['href', 'data:image/png;base64,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'],
            ['width', '50'],
            ['height', '20'],
        ]);
        this.addMarkerVisualToContainer(this.visual);
    }

    setPoints() {
        super.setSize();
        SvgHelper.setAttributes(this.visual, [
            ['href', 'data:image/png;base64,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'],
            ['width', this.width],
            ['height', this.height],
        ]);
    }

    pointerDown(point, target) {
        super.pointerDown(point, target);
        if (this.state === 'new') {
            this.createVisual();
            this.moveVisual(point);
            this._state = 'creating';
        }
    }

    resize(point) {
        super.resize(point);
        this.setPoints();
    }

    pointerUp(point) {
        super.pointerUp(point);
        this.setPoints();
    }

    ownsTarget(el) {
        if (super.ownsTarget(el) || el === this.visual) {
            return true;
        } else {
            return false;
        }
    }

    setStrokeColor(color) {
        this.strokeColor = color;
        if (this.visual) {
            SvgHelper.setAttributes(this.visual, [['stroke', this.strokeColor]]);
        }
    }

    get toolboxPanels() {
        return [this.strokePanel];
    }

    getState() {
        const result = Object.assign({
            strokeColor: this.strokeColor
        }, super.getState());
        result.typeName = BillboardMarker.typeName;

        return result;
    }

    restoreState(state) {
        const rectState = state;
        this.strokeColor = rectState.strokeColor;

        this.createVisual();
        super.restoreState(state);
        this.setPoints();
    }

    scale(scaleX, scaleY) {
        super.scale(scaleX, scaleY);
        this.setPoints();
    }
}

BillboardMarker.typeName = 'BillboardMarker';
BillboardMarker.title = 'Wall Banner Marker';
BillboardMarker.icon = '<svg fill="#ffffff" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.00 512.00" xml:space="preserve" stroke="#ffffff" stroke-width="0.00512"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M501.801,90.419h-80.452V75.12h29.698c5.632,0,10.199-4.566,10.199-10.199V32.127c0-5.633-4.567-10.199-10.199-10.199 h-79.796c-5.632,0-10.199,4.566-10.199,10.199v32.793c0,5.633,4.567,10.199,10.199,10.199h29.699v15.299H266.199V75.12h29.699 c5.632,0,10.199-4.566,10.199-10.199V32.127c0-5.633-4.567-10.199-10.199-10.199h-79.797c-5.632,0-10.199,4.566-10.199,10.199 v32.793c0,5.633,4.567,10.199,10.199,10.199h29.699v15.299H111.05V75.12h29.699c5.632,0,10.199-4.566,10.199-10.199V32.127 c0-5.633-4.567-10.199-10.199-10.199H60.953c-5.632,0-10.199,4.566-10.199,10.199v32.793c0,5.633,4.567,10.199,10.199,10.199 h29.698v15.299H10.199C4.567,90.419,0,94.985,0,100.618v264.867c0,5.633,4.567,10.199,10.199,10.199h205.004v10.355H45.896 c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h169.307v73.434c0,5.633,4.567,10.199,10.199,10.199 h61.195c5.632,0,10.199-4.566,10.199-10.199v-73.434h169.307c5.632,0,10.199-4.566,10.199-10.199 c0-5.633-4.567-10.199-10.199-10.199H296.797v-10.355h205.004c5.632,0,10.199-4.566,10.199-10.199V100.618 C512,94.985,507.433,90.419,501.801,90.419z M381.45,54.722V42.327h59.397v12.395H381.45z M226.301,54.722V42.327h0h59.398v12.395 H226.301z M71.153,54.722V42.327h59.397v12.395H71.153z M276.398,469.673h-40.797v-63.235h40.797V469.673z M276.398,386.04 h-40.797v-10.355h40.797V386.04z M491.602,355.286H20.398V110.817h471.203V355.286z"></path> </g> </g> <g> <g> <path d="M187.665,123.92H47.936c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h139.729 c5.632,0,10.199-4.566,10.199-10.199C197.865,128.487,193.297,123.92,187.665,123.92z"></path> </g> </g> <g> <g> <path d="M228.462,123.92h-8.159c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h8.159 c5.632,0,10.199-4.566,10.199-10.199C238.661,128.487,234.094,123.92,228.462,123.92z"></path> </g> </g> </g></svg>';

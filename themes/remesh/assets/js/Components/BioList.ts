'use strict';

declare var animatedSquiggles: any;
declare var animatedSquiggleDelay: any;
declare var squiggleColors: any;

export default class BioList {
    private squiggle:HTMLElement = null;
    private svg:SVGElement = null;
    private topPaths:SVGPathElement[] = [];
    private rightPaths:SVGPathElement[] = [];
    private leftPaths:SVGPathElement[] = [];
    private colors:string[] = [];
    private timer:number = 0;
    private currentColor:string = '#000';

    private activeElement:HTMLElement = null;

    private animate:boolean = true;
    private animateDelay:number = 100;

    constructor() {
        this.squiggle = document.querySelector('div.squiggle');

        if (this.squiggle == null) {
            return;
        }

        this.svg = this.squiggle.querySelector('svg');
        if (this.svg == null) {
            return;
        }

        this.animate = animatedSquiggles;
        this.animateDelay = animatedSquiggleDelay;
        this.colors = squiggleColors;

        if (this.colors.length == 0) {
            this.colors.push('#000');
            this.colors.push('#0073E3');
            this.colors.push('#24DBC3');
            this.colors.push('#F34F3F');
        }

        this.topPaths.push(this.svg.querySelector('#t-squig-1'));
        this.topPaths.push(this.svg.querySelector('#t-squig-2'));
        this.topPaths.push(this.svg.querySelector('#t-squig-3'));
        this.topPaths.push(this.svg.querySelector('#t-squig-4'));

        this.rightPaths.push(this.svg.querySelector('#r-squig-1'));
        this.rightPaths.push(this.svg.querySelector('#r-squig-2'));
        this.rightPaths.push(this.svg.querySelector('#r-squig-3'));
        this.rightPaths.push(this.svg.querySelector('#r-squig-4'));

        this.leftPaths.push(this.svg.querySelector('#l-squig-1'));
        this.leftPaths.push(this.svg.querySelector('#l-squig-2'));
        this.leftPaths.push(this.svg.querySelector('#l-squig-3'));
        this.leftPaths.push(this.svg.querySelector('#l-squig-4'));

        document.querySelectorAll('.bio-list-image').forEach(function(ele: HTMLElement){
            ele.addEventListener('mouseenter', function(e:Event) {
                this.show(ele);
            }.bind(this));

            ele.addEventListener('mouseleave', function(e:Event) {
                this.hide(ele);
            }.bind(this));
        }.bind(this));
    }

    show(e:HTMLElement) {
        let lastColor = this.currentColor;

        while (lastColor == this.currentColor) {
            const s = Math.floor(Math.random() * this.colors.length);
            this.currentColor = this.colors[s];
        }

        clearTimeout(this.timer);

        if (this.activeElement) {
            this.hide(this.activeElement);
            this.activeElement = null;
        }

        this.activeElement = e;
        this.configure();
        e.prepend(this.squiggle);

        if (this.animate) {
            this.timer = setTimeout(function(){
                this.doTimer();
            }.bind(this), this.animateDelay);
        }
    }

    hide(e:HTMLElement) {
        clearTimeout(this.timer);
        this.squiggle.remove();
    }

    doTimer() {
        this.configure();
        this.timer = setTimeout(function(){
            this.doTimer();
        }.bind(this), this.animateDelay);
    }

    configure() {

        const t = Math.floor(Math.random() * this.topPaths.length);
        const r = Math.floor(Math.random() * this.rightPaths.length);
        const l = Math.floor(Math.random() * this.leftPaths.length);

        for(let i=0; i < this.topPaths.length; i++) {
            this.topPaths[i].setAttribute('opacity', (i == t) ? '1' : '0');
            this.topPaths[i].setAttribute('fill', this.currentColor);
        }

        for(let i=0; i < this.rightPaths.length; i++) {
            this.rightPaths[i].setAttribute('opacity', (i == r) ? '1' : '0');
            this.rightPaths[i].setAttribute('fill', this.currentColor);
        }

        for(let i=0; i < this.leftPaths.length; i++) {
            this.leftPaths[i].setAttribute('opacity', (i == l) ? '1' : '0');
            this.leftPaths[i].setAttribute('fill', this.currentColor);
        }

        const angle = Math.floor(Math.random() * 360);
        this.svg.style.cssText = 'transform: rotateZ('+angle+'deg)';

    }
}
'use strict';


import ParallaxElement from "./ParallaxElement";

export default class Parallax {
    private eles:ParallaxElement[] = [];
    private docHeight:number = 0;
    private viewportHeight:number = 0;

    private lastScroll:number = 0;
    private scrolling:boolean = false;

    constructor() {
        const scrollY:number = window.pageYOffset || document.documentElement.scrollTop;
        this.docHeight = document.body.clientHeight;
        this.viewportHeight = window.innerHeight;

        const selectors = '.bg-ornament-1, .bg-ornament-2, .bg-int-ornament-1, .bg-int-ornament-2, .bg-other-ornament-1, .bg-other-ornament-2';
        document.querySelectorAll(selectors).forEach(function(ele: HTMLElement){
            const computed = window.getComputedStyle(ele);
            if ((computed.transform == 'none') && (computed.display != 'none')) {
                this.eles.push(new ParallaxElement(ele, scrollY, this.docHeight, this.viewportHeight));
            }
        }.bind(this));

        window.addEventListener('scroll', function(e:Event){
            const scrollY:number = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollY != this.lastScroll) {
                this.lastScroll = scrollY;
                this.scrolling = true;
            }
        }.bind(this));

        window.addEventListener('resize', function(e:Event) {
            this.lastScroll = window.pageYOffset || document.documentElement.scrollTop;
            this.docHeight = document.body.clientHeight;
            this.viewportHeight = window.innerHeight;

            this.eles.forEach(function(ele:ParallaxElement) {
                ele.init(this.lastScroll, this.docHeight, this.viewportHeight);
            }.bind(this));
        }.bind(this));

        const main:HTMLElement = document.querySelector('body > main');
        main.style.cssText = 'overflow-y: hidden';

        requestAnimationFrame(this.animateFrame.bind(this));
    }

    animateFrame() {
        if (this.scrolling) {
            this.eles.forEach(function(ele:ParallaxElement) {
                ele.update(this.lastScroll, this.docHeight, this.viewportHeight);
            }.bind(this));
        }

        this.scrolling = false;

        requestAnimationFrame(this.animateFrame.bind(this));
    }
}
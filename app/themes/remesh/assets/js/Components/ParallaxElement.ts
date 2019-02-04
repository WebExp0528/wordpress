'use strict';


export default class ParallaxElement {
    private pageOff:number = 0;
    private speed:number = -0.125;

    private ele:HTMLElement = null;
    private section:HTMLElement = null;

    constructor(ele:HTMLElement, scrollY:number, docHeight:number, viewportHeight:number) {
        this.ele = ele;

        this.speed = -(((Math.random() * 150) + 25) / 1000.0);

        if (window.innerWidth <= 414) {
            this.speed = this.speed / 2.0;
        }

        let parent = ele.parentElement;
        while(parent.tagName.toUpperCase() != 'SECTION') {
            parent = parent.parentElement;
            if (parent == null) {
                break;
            }
        }

        this.section = parent;

        this.init(scrollY, docHeight, viewportHeight);
    }

    init(scrollY:number, docHeight:number, viewportHeight:number) {
        if (this.section == null) {
            return;
        }

        const rect = this.section.getBoundingClientRect();

        let oy = scrollY + rect.top;
        let deltaY = ((viewportHeight - rect.height) / 2.0);

        this.pageOff = oy - deltaY;

        this.update(scrollY, docHeight, viewportHeight);
    }

    update(scrollY:number, docHeight:number, viewportHeight:number) {
        if (this.section == null) {
            return;
        }

        const distance:number = ((scrollY - this.pageOff) * -1) * this.speed;
        this.ele.style.cssText = "transform: translate3d(0, "+distance+"px, 0)";
    }

}
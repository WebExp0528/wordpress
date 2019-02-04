'use strict';
export default class TransitionGroup {
    readonly section:HTMLElement = null;
    private elements:HTMLElement[] = [];

    private boundingBox:ClientRect = { bottom: 0, left: Number.MAX_VALUE, right: 0, top: Number.MAX_VALUE, height: 0, width: 0};

    constructor(section: HTMLElement) {

        this.section = section;
        document.querySelectorAll('[data-transition]').forEach(function(ele: HTMLElement){
            console.log(ele);
        }.bind(this));
    }

    addElement(ele:HTMLElement) {
        this.elements.push(ele);
    }

    prepare(scrollY:number, viewportHeight:number, docHeight:number) {
        this.elements.forEach(function(ele: HTMLElement) {
            const rect = ele.getBoundingClientRect();
            if (rect.left < this.boundingBox.left) {
                this.boundingBox.left = rect.left;
            }

            if (rect.top < this.boundingBox.top) {
                this.boundingBox.top = rect.top;
            }

            if (rect.right > this.boundingBox.right) {
                this.boundingBox.right = rect.right;
            }

            if (rect.bottom > this.boundingBox.bottom) {
                this.boundingBox.bottom = rect.bottom;
            }
        }.bind(this));

        if (this.visibleInScroll(scrollY, viewportHeight, 1.0)) {
            this.section.classList.add('transition--in');
        }
    }

    visibleInScroll(scrollY:number, viewportHeight:number, multiplier: number) {
        return (this.boundingBox.top < (scrollY + (viewportHeight * multiplier)));
    }

    update(scrollY:number, viewportHeight:number, docHeight:number) {
        if (this.visibleInScroll(scrollY, viewportHeight, 0.85)) {
            this.section.classList.add('transition--in');
        }
    }

}
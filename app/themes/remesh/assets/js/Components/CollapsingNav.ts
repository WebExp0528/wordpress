'use strict';

export default class CollapsingNav {
    private headerHeight:number = 0;
    private collapseHeight:number = 0;
    private scrollMax:number = 0;
    private willHideOffset:number = 0;
    private hiddenOffset:number = 0;
    private ticking:boolean = false;
    private y:number = 0;
    private firstSection:HTMLElement = null;

    constructor() {
        this.headerHeight = document.querySelector('header').offsetHeight;

        this.scrollMax = this.headerHeight + (this.headerHeight / 2);

        this.willHideOffset = this.scrollMax;
        this.hiddenOffset = 0;

        this.firstSection = document.querySelector('main > section:first-of-type');
        this.collapseHeight = this.firstSection.offsetHeight;

        window.addEventListener('resize', function(e){
            this.collapseHeight = this.firstSection.offsetHeight;
        }.bind(this));

        window.addEventListener('scroll', function(e) {
            this.y = window.scrollY;

            if (!this.ticking) {
                window.requestAnimationFrame(function() {
                    this.handleScroll();
                    this.ticking = false;
                }.bind(this));

                this.ticking = true;
            }
        }.bind(this));
    }


    handleScroll() {
        if (!document.body.classList.contains('hide-nav') && (this.y >= this.willHideOffset) && (this.y >= this.scrollMax)) {
            document.body.classList.add('hide-nav');

            let event:Event = new Event('nav-collapsed');
            document.dispatchEvent(event);
        }

        if (document.body.classList.contains('hide-nav')) {
            if (this.y <= this.hiddenOffset) {
                this.willHideOffset = this.hiddenOffset + this.scrollMax;
                document.body.classList.remove('hide-nav');
            }

            this.hiddenOffset = this.y ;
        } else {
            if (this.y  <= this.willHideOffset - this.scrollMax) {
                this.willHideOffset = this.y  - this.scrollMax;
            }
        }

        if ((this.y < this.collapseHeight) && document.body.classList.contains('collapsed-nav')) {
            document.body.classList.remove('collapsed-nav');
        } else if ((this.y >= this.collapseHeight) && document.body.classList.contains('hide-nav')) {
            document.body.classList.add('collapsed-nav');
        }
    }
}
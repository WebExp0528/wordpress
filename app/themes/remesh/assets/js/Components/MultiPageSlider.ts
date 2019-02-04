'use strict';

export default class MultiPageSlider {
    private ele:HTMLElement = null;

    private pages:HTMLElement[] = [];
    private activePage:HTMLElement = null;

    private transitioning:boolean = false;

    constructor(ele:HTMLElement) {
        this.ele = ele;

        ele.querySelectorAll('div.page').forEach(function(pageEle:HTMLElement) {
            if (pageEle.classList.contains('active')) {
                this.activePage = pageEle;
            }

            this.pages.push(pageEle);
        }.bind(this));

        ele.querySelectorAll('div.nav > a.previous').forEach(function(ele:HTMLAnchorElement){
            ele.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.previousPage();
                return false;
            }.bind(this));
        }.bind(this));


        ele.querySelectorAll('div.nav > a.next').forEach(function(ele:HTMLAnchorElement){
            ele.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.nextPage();
                return false;
            }.bind(this));
        }.bind(this));
    }

    showPage(pageEle:HTMLElement, fromLeft:Boolean) {
        if (this.transitioning || (pageEle === this.activePage)) {
            return;
        }

        this.transitioning = true;

        if (this.activePage != null) {
            var currentPage = this.activePage;

            currentPage.classList.add('transition');
            setTimeout(function(){
                currentPage.classList.remove('active');
                currentPage.classList.add((fromLeft) ? 'in' : 'out');

                setTimeout(function(){
                    currentPage.classList.remove('transition');
                    setTimeout(function(){
                        currentPage.classList.remove('out','in');
                        this.transitioning = false;
                    }.bind(this), 30);
                }.bind(this), 750);
            }.bind(this), 30);

            this.activePage = null;
        }

        this.activePage = pageEle;

        this.activePage.classList.add((fromLeft) ? 'out' : 'in');
        setTimeout(function(){
            this.activePage.classList.add('transition');
            setTimeout(function(){
                this.activePage.classList.remove('out','in');
                this.activePage.classList.add('active');
                setTimeout(function(){
                    this.activePage.classList.remove('transition');
                }.bind(this), 750);
            }.bind(this), 30);
        }.bind(this), 30);

    }

    nextPage() {
        let pageIndex = this.pages.indexOf(this.activePage);
        pageIndex++;
        if (pageIndex >= this.pages.length) {
            pageIndex = 0;
        }

        this.showPage(this.pages[pageIndex], false);
    }

    previousPage() {
        let pageIndex = this.pages.indexOf(this.activePage);
        pageIndex--;
        if (pageIndex < 0) {
            pageIndex = this.pages.length - 1;
        }

        this.showPage(this.pages[pageIndex], true);
    }
}
'use strict';

export default class MultiPage {
    private ele:HTMLElement = null;

    private tabs:HTMLAnchorElement[] = [];
    private pages:HTMLElement[] = [];

    private activeTab:HTMLAnchorElement = null;
    private activePage:HTMLElement = null;

    private transitioning:boolean = false;

    constructor(ele:HTMLElement) {
        this.ele = ele;

        ele.querySelectorAll('div.tabs > a').forEach(function(linkEle:HTMLAnchorElement){
            this.tabs.push(linkEle);

            if (linkEle.classList.contains('active')) {
                this.activeTab = linkEle;
            }

            linkEle.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.tabClicked(linkEle);
                return false;
            }.bind(this));
        }.bind(this));

        ele.querySelectorAll('div.page').forEach(function(pageEle:HTMLElement) {
            if (pageEle.classList.contains('active')) {
                this.activePage = pageEle;
            }

             this.pages.push(pageEle);
        }.bind(this));

        ele.querySelectorAll('div.nav > a.previous').forEach(function(ele:HTMLAnchorElement){
            ele.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.previousTab();
                return false;
            }.bind(this));
        }.bind(this));


        ele.querySelectorAll('div.nav > a.next').forEach(function(ele:HTMLAnchorElement){
            ele.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.nextTab();
                return false;
            }.bind(this));
        }.bind(this));
    }

    tabClicked(linkEle:HTMLAnchorElement) {
        if (this.transitioning || (linkEle === this.activeTab)) {
            return;
        }

        const currentIndex = (this.activeTab != null) ? this.tabs.indexOf(this.activeTab) : -1;
        const nextIndex = this.tabs.indexOf(linkEle);

        this.showTab(linkEle, (nextIndex < currentIndex));
    }

    showTab(linkEle:HTMLAnchorElement, fromLeft:Boolean) {
        if (this.transitioning || (linkEle === this.activeTab)) {
            return;
        }

        this.transitioning = true;

        if (this.activeTab != null) {
            this.activeTab.classList.remove('active');
            this.activeTab = null;
        }

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

        this.activeTab = linkEle;
        this.activeTab.classList.add('active');

        const pageIndex = this.tabs.indexOf(this.activeTab);
        this.activePage = this.pages[pageIndex];

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

    nextTab() {
        let pageIndex = this.tabs.indexOf(this.activeTab);
        pageIndex++;
        if (pageIndex >= this.tabs.length) {
            pageIndex = 0;
        }

        this.showTab(this.tabs[pageIndex], false);
    }

    previousTab() {
        let pageIndex = this.tabs.indexOf(this.activeTab);
        pageIndex--;
        if (pageIndex < 0) {
            pageIndex = this.tabs.length - 1;
        }

        this.showTab(this.tabs[pageIndex], true);
    }
}
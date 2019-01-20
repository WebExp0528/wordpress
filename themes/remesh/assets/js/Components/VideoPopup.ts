'use strict';

import DomTools from "../Tools/DomTools";

export default class VideoPopup {
    private background:HTMLElement = null;
    private currentContainer:HTMLElement = null;

    constructor() {
        this.background = <HTMLElement>DomTools.createElement("<div id='video-popup-bg' class='hidden'></div>");
        this.background.addEventListener('click', function(e){
            e.preventDefault();
            this.closePopup();
            return false;
        }.bind(this));

        const button:HTMLLinkElement = <HTMLLinkElement>DomTools.createElement("<a href='#' class='video-popup-close'>Close</a>");
        this.background.prepend(button);
        button.addEventListener('click', function(e:Event) {
            e.preventDefault();
            this.closePopup();
            return false;
        }.bind(this));

        this.background.addEventListener('scrollwheel', function(e) {
            e.preventDefault();
            return false;
        });

        document.querySelectorAll('a.video-popup').forEach(function(ele:HTMLLinkElement) {
            ele.addEventListener('click', function(e:Event) {
                e.preventDefault();
                this.showPopup(ele);
                return false;
            }.bind(this));
        }.bind(this));
    }

    showPopup(link:HTMLLinkElement) {
        const template = link.querySelector("script[type='text/template']").textContent;
        if (template == null) {
            return;
        }

        document.body.append(this.background);
        document.documentElement.classList.add('no-scroll');
        (<any>document).addEventListener('touchmove', this.freeze, { passive: false });

        const embed:HTMLElement = <HTMLElement>DomTools.createElement(template);
        this.currentContainer = <HTMLElement>DomTools.createElement("<div class='video-popup-container'></div>");
        this.currentContainer.prepend(embed);
        this.background.prepend(this.currentContainer);

        setTimeout(function(){
            this.background.classList.remove('hidden');
        }.bind(this), 0);
    }

    closePopup() {
        (<any>document).removeEventListener('touchmove', this.freeze, { passive: false });
        this.background.classList.add('hidden');
        document.documentElement.classList.remove('no-scroll');
        setTimeout(function(){
            this.background.remove();
            this.currentContainer.remove();
            this.currentContainer = null;
        }.bind(this), 600);
    }

    freeze(e:Event) {
        e.preventDefault();
        return false;
    }
}
'use strict';

import DomTools from "../Tools/DomTools";

export default class Hamburglar {
    private mobileMenu:HTMLElement = null;
    private hamburger:HTMLElement = null;
    private background = null;

    constructor() {
        this.background = DomTools.createElement("<div id='mobile-bg' class='hidden'></div>");
        this.background.addEventListener('click', function(e){
            e.preventDefault();
            this.close();
            return false;
        }.bind(this));

        this.background.addEventListener('scrollwheel', function(e) {
            e.preventDefault();
           return false;
        });



        this.mobileMenu = document.getElementById('mobile-menu');
        this.hamburger = document.querySelector('.hamburger');

        this.hamburger.addEventListener('click',function(e){
            if (this.hamburger.classList.contains('is-active')) {
                this.close();
            } else {
                this.open();
            }
        }.bind(this));
    }

    open() {
        (<any>document).addEventListener('touchmove', this.freeze, { passive: false });
        document.documentElement.classList.add('no-scroll');
        this.mobileMenu.insertAdjacentElement('beforebegin', this.background);

        this.hamburger.classList.add('is-active');
        this.mobileMenu.classList.remove('removed');
        setTimeout(function(){
            this.mobileMenu.classList.remove('hidden');
            this.background.classList.remove('hidden');
        }.bind(this), 0);
    }

    close() {
        (<any>document).removeEventListener('touchmove', this.freeze, { passive: false });
        document.documentElement.classList.remove('no-scroll');
        this.background.classList.add('hidden');
        this.hamburger.classList.remove('is-active');
        this.mobileMenu.classList.add('hidden');
        setTimeout(function(){
            this.mobileMenu.classList.add('removed');
            this.background.remove();
        }.bind(this), 600);
    }

    freeze(e:Event) {
        e.preventDefault();
        return false;
    }
}
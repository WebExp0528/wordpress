'use strict';

export default class Testimonials {
    private ele:HTMLElement;
    private testimonies:Array<HTMLElement> = [];
    private logos:Array<HTMLElement> = [];

    private currentTestimony:HTMLElement = null;
    private currentLogo:HTMLElement = null;

    private currentIndex:number = 0;

    constructor(ele:HTMLElement) {
        this.ele = ele;

        let testimonyContainer:HTMLElement = ele.querySelector('.testimonials-container');
        let containerChildren = [].slice.call(testimonyContainer.children);
        for (let testimony of containerChildren) {
            this.testimonies.push(testimony);
        }

        let logosContainer:HTMLElement = ele.querySelector('.logos-container');
        let logosChildren = [].slice.call(logosContainer.children);
        for (let testimony of logosChildren) {
            this.logos.push(testimony);
        }

        this.currentTestimony = this.testimonies[0];
        this.currentLogo = this.logos[0];

        let previous = ele.querySelector('.nav > a.previous');
        previous.addEventListener('click', function(e:Event) {
            e.preventDefault();
            this.previous();
            return false;
        }.bind(this));


        let next = ele.querySelector('.nav > a.next');
        next.addEventListener('click', function(e:Event) {
            e.preventDefault();
            this.next();
            return false;
        }.bind(this));
    }

    private previous() {
        this.currentIndex--;
        if (this.currentIndex < 0) {
            this.currentIndex = this.testimonies.length - 1;
        }

        this.displayTestimony();
    }

    private next() {
        this.currentIndex++;
        if (this.currentIndex >= this.testimonies.length) {
            this.currentIndex = 0;
        }

        this.displayTestimony();
    }

    private displayTestimony() {
        this.currentTestimony.style.opacity = "0";
        this.currentLogo.style.opacity = "0";

        this.currentTestimony = this.testimonies[this.currentIndex];
        this.currentLogo = this.logos[this.currentIndex];

        this.currentTestimony.style.opacity = "1";
        this.currentLogo.style.opacity = "1";
    }

    public static start() {
        document.querySelectorAll('.testimonial-slider').forEach(function(ele:HTMLElement) {
            new Testimonials(ele);
        });
    }
}
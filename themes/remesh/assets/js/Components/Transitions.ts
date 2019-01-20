'use strict';

import TransitionGroup from "./TransitionGroup";
import ParallaxElement from "./ParallaxElement";

export default class Transitions {
    private groups:TransitionGroup[] = [];

    private docHeight:number = 0;
    private viewportHeight:number = 0;

    private lastScroll:number = 0;
    private scrolling:boolean = false;

    constructor() {
        this.lastScroll = window.pageYOffset || document.documentElement.scrollTop;
        this.docHeight = document.body.clientHeight;
        this.viewportHeight = window.innerHeight;

        document.querySelectorAll('[data-transition]').forEach(function(ele: HTMLElement){
            const section = this.getSection(ele);
            if (section == null) {
                return;
            }

            let group = this.getGroup(section);
            if (group == null) {
                group = new TransitionGroup(section);
                this.groups.push(group);
            }

            group.addElement(ele);
        }.bind(this));

        this.groups.forEach(function(group: TransitionGroup) {
            group.prepare(this.lastScroll, this.viewportHeight, this.docHeight);
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

            this.groups.forEach(function(group:TransitionGroup) {
                group.prepare(this.lastScroll, this.viewportHeight, this.docHeight);
            }.bind(this));
        }.bind(this));

        requestAnimationFrame(this.animateFrame.bind(this));
    }

    animateFrame() {
        if (this.scrolling) {
            this.groups.forEach(function(group:TransitionGroup) {
                group.update(this.lastScroll, this.viewportHeight, this.docHeight);
            }.bind(this));
        }

        this.scrolling = false;

        requestAnimationFrame(this.animateFrame.bind(this));
    }

    private getSection(ele:HTMLElement) {
        let parent = ele.parentElement;
        while(parent.tagName.toLowerCase() != 'section') {
            parent = parent.parentElement;
            if (parent == null) {
                return null;
            }
        }

        return parent;
    }

    private getGroup(section:HTMLElement) {
        const filteredGroups = this.groups.filter(group => group.section === section);
        if (filteredGroups.length == 0) {
            return null;
        }

        return filteredGroups[0];
    }

}
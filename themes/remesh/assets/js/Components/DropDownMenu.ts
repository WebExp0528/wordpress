'use strict';

export interface DropDownMenuDelegate {
    menuActivated(menu:DropDownMenu);
    menuDeactivated(menu:DropDownMenu);
}

export default class DropDownMenu {
    private anchor:HTMLAnchorElement = null;
    private subMenu:HTMLElement = null;
    private delegate:DropDownMenuDelegate = null;
    private hideTimer:number = 0;

    constructor(anchor:HTMLAnchorElement, subMenu:HTMLElement, delegate:DropDownMenuDelegate) {
        this.anchor = anchor;
        this.subMenu = subMenu;
        this.delegate = delegate;

        this.anchor.addEventListener('mouseover', function(e:Event) {
            clearTimeout(this.hideTimer);
            this.delegate.menuActivated(this);
        }.bind(this));

        this.anchor.addEventListener('mouseout', function(e:Event) {
            clearTimeout(this.hideTimer);
            this.hideTimer = setTimeout(function(){
                this.delegate.menuDeactivated(this);
            }.bind(this), 50);
        }.bind(this));

        this.subMenu.addEventListener('mouseover', function(e:Event) {
            clearTimeout(this.hideTimer);
            this.subMenu.addEventListener('mouseleave', this.exitSubmenu.bind(this));
        }.bind(this));
    }

    show() {
        this.subMenu.classList.add('visible');
    }

    hide() {
        this.subMenu.classList.remove('visible');
        this.subMenu.removeEventListener('mouseleave', this.exitSubmenu);
    }

    exitSubmenu(e:Event) {
        this.hideTimer = setTimeout(function(){
            this.subMenu.removeEventListener('mouseleave', this.exitSubmenu);
            this.delegate.menuDeactivated(this);
        }.bind(this), 50);
    }
}
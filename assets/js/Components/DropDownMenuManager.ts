'use strict';

import DropDownMenu, {DropDownMenuDelegate} from "./DropDownMenu";

export default class DropDownMenuManager implements DropDownMenuDelegate {
    private menus:DropDownMenu[] = [];
    private activeMenu:DropDownMenu = null;

    constructor() {
        document.querySelectorAll('li.has-sub-menu').forEach(function(ele:HTMLElement) {
            let anchor:HTMLAnchorElement = ele.querySelector('a');
            let subMenu:HTMLElement = ele.querySelector('div.sub-menu');

            this.menus.push(new DropDownMenu(anchor, subMenu, this));
        }.bind(this));

        document.addEventListener('nav-collapsed', function(e:Event){
            if (this.activeMenu) {
                this.menuDeactivated(this.activeMenu);
            }
        }.bind(this));
    }

    menuActivated(menu:DropDownMenu) {
        if (this.activeMenu == menu) {
            return;
        }

        if (this.activeMenu != null) {
            this.activeMenu.hide();
        }

        this.activeMenu = menu;
        this.activeMenu.show();
    }

    menuDeactivated(menu:DropDownMenu) {
        if (this.activeMenu == menu) {
            this.activeMenu = null;
        }

        menu.hide();
    }
}
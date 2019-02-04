'use strict';
import 'nodelist-foreach-polyfill';
import 'classlist-polyfill';
import Breakpoints from './Components/Breakpoints';
import Testimonials from './Components/Testimonials';
import CollapsingNav from "./Components/CollapsingNav";
import DropDownMenuManager from "./Components/DropDownMenuManager";
import MultiPage from "./Components/MultiPage";
import MultiPageSlider from "./Components/MultiPageSlider";
import Hamburglar from "./Components/Hamburglar";
import Parallax from "./Components/Parallax";
import BioList from "./Components/BioList";
import 'dom4';
import VideoPopup from "./Components/VideoPopup";
import Transitions from "./Components/Transitions";

var breakpoints = null;
document.addEventListener('DOMContentLoaded', function () {
    breakpoints = new Breakpoints();

    new CollapsingNav();
    new DropDownMenuManager();

    Testimonials.start();

    document.querySelectorAll('.multi-page-standard').forEach(function(ele:HTMLElement){
        new MultiPage(ele);
    });

    document.querySelectorAll('.multi-page-stacked').forEach(function(ele:HTMLElement){
        new MultiPage(ele);
    });

    document.querySelectorAll('.multi-page-slider').forEach(function(ele:HTMLElement){
        new MultiPageSlider(ele);
    });

    new Hamburglar();

    new Parallax();

    new BioList();

    new VideoPopup();

    new Transitions();
});
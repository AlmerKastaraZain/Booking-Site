import './bootstrap';
import Swiper from 'swiper';

import { Navigation, Pagination } from 'swiper/modules';


window.Swiper = Swiper
window.Navigation = Navigation
window.Pagination = Pagination

// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'
import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';
import localeEn from  'air-datepicker/locale/en' ;

// In Range datepicker
new AirDatepicker('#ci', {
    locale: localeEn,
    range: true,
    multipleDatesSeparator: ' - ',
    showOtherMonths: true,
    clearButton: true,
    dateFormat: 'dd MMMM yyyy',
    minDate: new Date() - 1
});



import flatpickr from "flatpickr";
import plugin from 'preline/plugin';

window.plugin = plugin;

import TomSelect from "tom-select";
window.TomSelect = TomSelect


import 'preline'

import "preline/preline";

import {loadConnectAndInitialize} from '@stripe/connect-js';

window.loadConnectAndInitialize = loadConnectAndInitialize;
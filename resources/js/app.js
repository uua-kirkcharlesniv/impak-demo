import './bootstrap';

import Alpine from 'alpinejs';

import party from 'party-js';

// Import Chart.js
import Chart from 'chart.js/auto';

// Import flatpickr
import flatpickr from 'flatpickr';

// Import TailwindCSS variables
import { tailwindConfig } from './utils';

import 'livewire-sortable';

import Sortable, { Swap } from 'sortablejs';
import ApexCharts from 'apexcharts'



// Call Alpine
window.Chart = Chart;
window.Alpine = Alpine;
window.party = party;
window.Sortable = Sortable;
window.Sortable.mount(new Swap());
Alpine.start();


// Define Chart.js default settings
/* eslint-disable prefer-destructuring */
Chart.defaults.font.family = '"Inter", sans-serif';
Chart.defaults.font.weight = '500';
Chart.defaults.color = tailwindConfig().theme.colors.slate[400];
Chart.defaults.scale.grid.color = tailwindConfig().theme.colors.slate[100];
Chart.defaults.plugins.tooltip.titleColor = tailwindConfig().theme.colors.slate[800];
Chart.defaults.plugins.tooltip.bodyColor = tailwindConfig().theme.colors.slate[800];
Chart.defaults.plugins.tooltip.backgroundColor = tailwindConfig().theme.colors.white;
Chart.defaults.plugins.tooltip.borderWidth = 1;
Chart.defaults.plugins.tooltip.borderColor = tailwindConfig().theme.colors.slate[200];
Chart.defaults.plugins.tooltip.displayColors = false;
Chart.defaults.plugins.tooltip.mode = 'nearest';
Chart.defaults.plugins.tooltip.intersect = false;
Chart.defaults.plugins.tooltip.position = 'nearest';
Chart.defaults.plugins.tooltip.caretSize = 0;
Chart.defaults.plugins.tooltip.caretPadding = 20;
Chart.defaults.plugins.tooltip.cornerRadius = 4;
Chart.defaults.plugins.tooltip.padding = 8;

// Register Chart.js plugin to add a bg option for chart area
Chart.register({
  id: 'chartAreaPlugin',
  // eslint-disable-next-line object-shorthand
  beforeDraw: (chart) => {
    if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
      const ctx = chart.canvas.getContext('2d');
      const { chartArea } = chart;
      ctx.save();
      ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
      // eslint-disable-next-line max-len
      ctx.fillRect(chartArea.left, chartArea.top, chartArea.right - chartArea.left, chartArea.bottom - chartArea.top);
      ctx.restore();
    }
  },
});

document.addEventListener('DOMContentLoaded', () => {
  flatpickr('.datepicker', {
    static: true,
    monthSelectorType: 'static',
    dateFormat: 'Y-m-d',
    altFormat: 'j F Y',
    altInput: true,
    prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    onReady: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
      const customClass = instance.element.getAttribute('data-class');
      instance.calendarContainer.classList.add(customClass);
    },
    onChange: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
    },
  });

  flatpickr('.timepicker', {
    static: true,
    enableTime: true,
    noCalendar: true,
    dateFormat: 'H:i',
    altFormat: 'h:i K',
    altInput: true,
    prevArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M5.4 10.8l1.4-1.4-4-4 4-4L5.4 0 0 5.4z" /></svg>',
    nextArrow: '<svg class="fill-current" width="7" height="11" viewBox="0 0 7 11"><path d="M1.4 10.8L0 9.4l4-4-4-4L1.4 0l5.4 5.4z" /></svg>',
    onReady: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
      const customClass = instance.element.getAttribute('data-class');
      instance.calendarContainer.classList.add(customClass);
    },
    onChange: (selectedDates, dateStr, instance) => {
      // eslint-disable-next-line no-param-reassign
      instance.element.value = dateStr.replace('to', '-');
    },
  });
  // dashboardCard01();
  // dashboardCard02();
  // dashboardCard03();
  // dashboardCard04();
  // dashboardCard05();
  // dashboardCard06();
  // dashboardCard08();
  // dashboardCard09();
  // analyticsCard01();
  // analyticsCard02();
  // analyticsCard03();
  // analyticsCard04();
  // analyticsCard08();
  // analyticsCard09();
  // analyticsCard10();
  // fintechCard01();
  // fintechCard03();
  // fintechCard04();
  // fintechCard07();
  // fintechCard08();
  // fintechCard09();
  // fintechCard10();
  // fintechCard11();
  // fintechCard12();
  // fintechCard13();
  // fintechCard14();  
});

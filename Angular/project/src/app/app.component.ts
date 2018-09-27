import { Component } from '@angular/core';

import 'jquery'; // Import jQuery

declare const $: any;

import 'fullpage.js'; // Import fullpage.js


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'app';
}

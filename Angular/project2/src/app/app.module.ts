import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { OutcontainerComponent } from './outcontainer/outcontainer.component';

@NgModule({
  declarations: [
    AppComponent,
    OutcontainerComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

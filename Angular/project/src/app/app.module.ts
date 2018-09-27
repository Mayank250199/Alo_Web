import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { TeamPageComponent } from './component/team-page/team-page.component';
import { MainPageComponent } from './component/main-page/main-page.component';
import { CubePageComponent } from './component/cube-page/cube-page.component';

@NgModule({
  declarations: [
    AppComponent,
    TeamPageComponent,
    MainPageComponent,
    CubePageComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

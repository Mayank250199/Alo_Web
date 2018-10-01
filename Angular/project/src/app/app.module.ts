import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AppComponent } from './app.component';
import { TeamPageComponent } from './component/team-page/team-page.component';
import { MainPageComponent } from './component/main-page/main-page.component';
import { CubePageComponent } from './component/cube-page/cube-page.component';
import { CardComponent } from './component/card/card.component';
import { PanoramaComponent } from './component/panorama/panorama.component';

//fullpage
//import { MnFullpageModule } from 'ngx-fullpage';
//import { MnFullpageDirective, MnFullpageService } from "ngx-fullpage";

@NgModule({
  declarations: [
    AppComponent,
    TeamPageComponent,
    MainPageComponent,
    CubePageComponent,
    CardComponent,
    PanoramaComponent
  ],
  imports: [
    BrowserModule,
    //MnFullpageModule.forRoot() ,
    //MnFullpageDirective
  ],
  schemas: [
    CUSTOM_ELEMENTS_SCHEMA
],
  providers: [
    //MnFullpageService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

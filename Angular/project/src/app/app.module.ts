import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { TeamPageComponent } from './component/team-page/team-page.component';
import { MainPageComponent } from './component/main-page/main-page.component';
import { CubePageComponent } from './component/cube-page/cube-page.component';

//fullpage
import { MnFullpageModule } from 'ngx-fullpage';
import { MnFullpageDirective, MnFullpageService } from "ng2-fullpage";

@NgModule({
  declarations: [
    AppComponent,
    TeamPageComponent,
    MainPageComponent,
    CubePageComponent
  ],
  imports: [
    BrowserModule,
    MnFullpageModule.forRoot() ,
    MnFullpageDirective
  ],
  providers: [
    MnFullpageService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

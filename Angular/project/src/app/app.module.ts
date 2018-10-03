import { BrowserModule } from '@angular/platform-browser';
import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';

import { AppComponent } from './app.component';
import { TeamPageComponent } from './component/team-page/team-page.component';
import { MainPageComponent } from './component/main-page/main-page.component';
import { CubePageComponent } from './component/cube-page/cube-page.component';
import { CardComponent } from './component/card/card.component';
import { PanoramaComponent } from './component/panorama/panorama.component';
import {RouterModule, Routes} from '@angular/router';
import { OuterpageComponent } from './component/outerpage/outerpage.component';
import { ContactComponent } from './component/contact/contact.component';
import { SolutionComponent } from './component/solution/solution.component';
//fullpage
//import { MnFullpageModule } from 'ngx-fullpage';
//import { MnFullpageDirective, MnFullpageService } from "ngx-fullpage";
const appRouts=[
  {path: 'team-page', component: TeamPageComponent, },
  {path: 'contact-page', component: ContactComponent, },
  {path: 'home', component: OuterpageComponent, pathMatch: 'full'},
  {path:'', pathMatch:'full', redirectTo:'/home'}
]

@NgModule({
  declarations: [
    AppComponent,
    TeamPageComponent,
    MainPageComponent,
    CubePageComponent,
    CardComponent,
    PanoramaComponent,
    OuterpageComponent,
    ContactComponent,
    SolutionComponent,
  ],
  imports: [
    RouterModule.forRoot(appRouts, {enableTracing:true}),
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

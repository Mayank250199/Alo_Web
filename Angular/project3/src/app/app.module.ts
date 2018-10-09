import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { OutcontainerComponent } from './outcontainer/outcontainer.component';
import { PanoramaComponent } from './outcontainer/components/panorama/panorama.component';
import { SolutionComponent } from './outcontainer/components/solution/solution.component';
import { CardsComponent } from './outcontainer/components/cards/cards.component';
import { TeamComponent } from './outcontainer/components/team/team.component';
import { ContactComponent } from './outcontainer/components/contact/contact.component';
import {MainPageComponent} from './outcontainer/components/main-page/main-page.component';
import { Routes, RouterModule} from '@angular/router';
import { PanormComponent } from './outcontainer/components/panorm/panorm.component';
import { WorkingComponent } from './outcontainer/components/working/working.component';

const appRouts=[
  {path: 'team-page', component: TeamComponent},
  {path: 'contact-page', component: ContactComponent, },
  {path: 'home', component: OutcontainerComponent, pathMatch: 'full'},
  {path:'', component:WorkingComponent, pathMatch:'full'}
]

@NgModule({
  declarations: [
    AppComponent,
    OutcontainerComponent,
    PanoramaComponent,
    SolutionComponent,
    CardsComponent,
    TeamComponent,
    ContactComponent,
    MainPageComponent,
    PanormComponent,
    WorkingComponent
  ],
  imports: [
    RouterModule.forRoot(appRouts, {enableTracing:false}),
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

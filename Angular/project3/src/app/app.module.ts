import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppComponent } from './app.component';
import { OutcontainerComponent } from './outcontainer/outcontainer.component';
import { PanoramaComponent } from './outcontainer/components/panorama/panorama.component';
import { SolutionComponent } from './outcontainer/components/solution/solution.component';
import { CardsComponent } from './outcontainer/components/cards/cards.component';
import { TeamComponent } from './outcontainer/components/team/team.component';
import { ContactComponent } from './outcontainer/components/contact/contact.component';

@NgModule({
  declarations: [
    AppComponent,
    OutcontainerComponent,
    PanoramaComponent,
    SolutionComponent,
    CardsComponent,
    TeamComponent,
    ContactComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }

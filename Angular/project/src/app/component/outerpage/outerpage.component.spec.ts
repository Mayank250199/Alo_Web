import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OuterpageComponent } from './outerpage.component';

describe('OuterpageComponent', () => {
  let component: OuterpageComponent;
  let fixture: ComponentFixture<OuterpageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OuterpageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OuterpageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { OutcontainerComponent } from './outcontainer.component';

describe('OutcontainerComponent', () => {
  let component: OutcontainerComponent;
  let fixture: ComponentFixture<OutcontainerComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ OutcontainerComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(OutcontainerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

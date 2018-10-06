import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PanormComponent } from './panorm.component';

describe('PanormComponent', () => {
  let component: PanormComponent;
  let fixture: ComponentFixture<PanormComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PanormComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PanormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

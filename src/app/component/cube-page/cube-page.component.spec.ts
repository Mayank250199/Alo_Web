import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CubePageComponent } from './cube-page.component';

describe('CubePageComponent', () => {
  let component: CubePageComponent;
  let fixture: ComponentFixture<CubePageComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CubePageComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CubePageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

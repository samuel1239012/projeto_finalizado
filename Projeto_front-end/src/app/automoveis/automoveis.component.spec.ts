import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AutomoveisComponent } from './automoveis.component';

describe('AutomoveisComponent', () => {
  let component: AutomoveisComponent;
  let fixture: ComponentFixture<AutomoveisComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AutomoveisComponent]
    });
    fixture = TestBed.createComponent(AutomoveisComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

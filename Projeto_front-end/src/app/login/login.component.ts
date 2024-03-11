import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ServicesService } from '../service.service';
import { FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  public formulario = this.formBuilder.group({
    email: [null, [Validators.required, Validators.email]],
    senha: [null, Validators.required],
  })


  constructor(
    private formBuilder: FormBuilder,
    private service: ServicesService,
    private route: Router
  ){}

  onSubmit(){
    
    this.service.getLogin(this.formulario.controls["email"].value, this.formulario.controls["senha"].value).subscribe((data: any) => {
      console.log("data =>" , data)
    })
       
  }


  
}

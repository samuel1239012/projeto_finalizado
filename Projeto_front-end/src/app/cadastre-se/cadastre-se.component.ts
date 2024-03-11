import { Component } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ServicesService } from '../service.service';
import { Router, Routes } from '@angular/router';

@Component({
  selector: 'app-cadastre-se',
  templateUrl: './cadastre-se.component.html',
  styleUrls: ['./cadastre-se.component.scss']
})
export class CadastreSeComponent {

    public formulario = this.formBuilder.group({
      nome: [null, Validators.required],
      cpf: [null, Validators.required],
      whatsapp: [null, Validators.required],
      email: [null, Validators.required],
      senha: [null, Validators.required],
    })

    constructor(
    private formBuilder: FormBuilder,
    private service: ServicesService,
    private route: Router
  ){ }

  onSubmit(){
    
    this.service.postCliente(this.formulario.value).subscribe((data: any) => {
      if(data["status"]== "success"){
        alert("Cadastro realizado com sucesso!")
        this.route.navigate(['/login'])
      } else{
        alert(data["error"])
        this.formulario.reset()
      }
    })

  }

}

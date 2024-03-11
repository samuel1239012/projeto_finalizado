import { NgModule, Component } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { QuemSomosComponent } from './quem-somos/quem-somos.component';
import { ContatoComponent } from './contato/contato.component';
import { ContComponent } from './cont/cont.component';
import { CadastreSeComponent } from './cadastre-se/cadastre-se.component';
import { AutomoveisComponent } from './automoveis/automoveis.component';
import { PoliticaComponent } from './politica/politica.component';
import { EsporteComponent } from './esporte/esporte.component';
import { EmAltaComponent } from './em-alta/em-alta.component';
import { NoticiaComponent } from './noticia/noticia.component';
import { LoginComponent } from './login/login.component';


const routes: Routes = [
  {
    path:'',
    component:HomeComponent
  },
  {
    path:'quem-somos',
    component:QuemSomosComponent
  },
  {
    path:'contato',
    component:ContatoComponent
  },
  {
    path:'cont',
    component:ContComponent
  },
  {
    path:'cadastre-se',
    component:CadastreSeComponent,
  },
  {
    path:'esporte',
    component:EsporteComponent,
  },
  {
    path:'automoveis',
    component:AutomoveisComponent
  },
  {
    path:'politica',
    component:PoliticaComponent
  },
  {
    path:'em-alta',
    component:EmAltaComponent
  },
  {
    path:'noticia',
    component:NoticiaComponent
  },
  {
    path:'noticia/:id',
    component:NoticiaComponent
  },
  {
    path:'login',
    component:LoginComponent
  },
  {
    path:'cadastre-se',
    component:CadastreSeComponent
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

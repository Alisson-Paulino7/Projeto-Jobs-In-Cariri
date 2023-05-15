
export class Cliente{
 

    constructor (){
     
    }
   
  salvar(){
       
    
    }
  ler(){
    
  }
  
  enviar(){

    }
}



export class AndamentoS extends Cliente{
    dtinicio
    dtentrega
    status = ['Concluido','Pendente','Andamento']
    contratado

    constructor (dtinicio,dtentrega,nome,status,contratado){
        super(nome)
        this.dtinicio = dtinicio
        this.dtentrega = dtentrega
        this.status = status
        this.contratado = contratado
    }

    get nome(){
        return this.nome
    }
    get dtinicio(){
        return this.dtinicio
    }
    get dtentrega(){
        return this.dtentrega
    }
    get status(){
        return this.status
    }
    get contratado(){
        return this.constratado
    }

}

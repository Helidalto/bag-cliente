# Laravel eCommerce Brazil Customer 

Módulo criado para adicionar campos de Pessoa Física e Jurídica requeridos pela maioria de métodos de pagamentos do mercado brasileiro.

**Campos adicionados:**
* person_type enum(person,company) - Tipo de Pessoa
    * person - Física
    * company - Jurídica
* document - CPF/CNPJ (Muda os labels de acordo com o Tipo de Pessoa selecionado)
* state_register - Inscrição Estadual (Apenas para PJ)
* company_name - Razão Social (Apenas para PJ)
* fantasy_name - Nome Fantasia (Apenas para PJ)
* general_register - RG

## Instalação

1- Run `composer require helidalto/bag-cliente` in your bagisto project

3- Rodar `php artisan migrate` adicionar os novos campos na tabela dos clientes.

## Configurações

Para configurar seu módulo acesse: Admin > Configurar > Cliente > Campos Brasileiros.

Configurações disponíveis:

* **Tipo de Pessoas Habilitadas**: Você pode escolher habilitar Pessoa Física, Jurídica ou os dois na sua loja.
* **Habilitar RG?**: Você habilita ou esconde o campo de RG na sua loja.
* **Habilitar Inscrição Estadual?**:Você habilita ou esconde o campo de Inscrição Estadual na sua loja
* **Habilitar Nome Fantasia?**:Você habilita ou esconde o campo de Nome Fantasia na sua loja


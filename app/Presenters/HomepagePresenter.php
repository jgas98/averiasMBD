<?php
declare( strict_types = 1 );

namespace App\Presenters;

final class HomepagePresenter extends BasePresenter {
    
    public function actionDefault() {}
    
    public function renderDefault() {
         
        $this->template->date = date("D");
        
        $user = $this->getDbUser();
        
        if($user->rol == "director"){
        
            $this->flashMessage('Bienvenido director '. $user->nombre , 'success');
        
            $this->redirect('Clases:default');
        
        } elseif($user->rol == "profesor"){
        
            $this->flashMessage('Bienvenido profesor '. $user->nombre , 'success');
        
            $this->redirect('Clases:default');
        
        }
    
    }
    
}

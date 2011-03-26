<?php

namespace Algernon\LeitnerBundle\Form;

use Symfony\Component\Form\Form;

class TaskForm extends Form
{

    public function configure()
    {
        $this->setDataClass('Algernon\\LeitnerBundle\\Entity\\Task');

        $this->add('question');
        $this->add('answer');
    }

}

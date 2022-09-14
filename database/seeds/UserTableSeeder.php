<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ClinicCase;
use App\Models\Image;
use App\Models\Comment;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user = new User();
            $user->name = 'Administrador';
            $user->lastname = '1';
            $user->email = 'admin1' . '@admin.com';
            $user->password = Hash::make('password');
            $user->gender = 'Hombre';
            $user->isDoctor = false;
            $user->role = 'ROLE_ADMIN';
            $user->status = true;
            $user->save();

            $user2 = new User();
            $user2->name = 'Administrador';
            $user2->lastname = '0';
            $user2->email = 'admin0@admin.com';
            $user2->password = Hash::make('password');
            $user2->gender = 'Hombre';
            $user2->isDoctor = false;
            $user2->role = 'ROLE_ADMIN';
            $user2->status = true;
            $user2->save();

            $user3 = new User();
            $user3->name = 'Cristhian';
            $user3->lastname = 'Ortiz Mercado';
            $user3->email = 'cristhianortizmercado@gmail.com';
            $user3->password = Hash::make('password');
            $user3->gender = 'Hombre';
            $user3->isDoctor = false;
            $user3->role = 'ROLE_USER';
            $user3->status = false;
            $user3->save();

            $user4 = new User();
            $user4->name = 'Roberto';
            $user4->lastname = 'Gomez';
            $user4->email = 'user0@user.com';
            $user4->password = Hash::make('password');
            $user4->gender = 'Hombre';
            $user4->isDoctor = true;
            $user4->role = 'ROLE_USER';
            $user4->status = true;
            $user4->save();

            $clinicCase1 = new ClinicCase();
            $clinicCase1->user_id = $user->id;
            $clinicCase1->title = 'Mordida cruzada anterior Placa Progenie – 02';
            $clinicCase1->description = 'Mordida cruzada anterior con incisivos inferiores proinclinados y tratado con una placa de progenie.';
            $clinicCase1->diagnostic = 'Paciente con 6 años de edad que presenta una mordida cruzada anterior dental (MCAD). En las imágenes intraorales iniciales observamos la mordida cruzada anterior a nivel de los incisivos centrales. En la radiotelegrafía lateral de cráneo vemos que el incisivo inferior está proinclinado respecto a su base ósea mandibular. La línea roja muestra el eje del diente actualmente mientras que la línea verde muestra la posición ideal donde debería estar el incisivo.';
            $clinicCase1->treatment_phase_one = 'El tratamiento que se eligió en este caso (2008) fue una placa de progenie con levantes de mordida y tornillo de protrusión.';
            $clinicCase1->procedure_phase_one = 'La duración de tratamiento fue de 4 meses y consistió en la activación del arco de progenie con el alicate de tres puntas para ejercer una ligera presión hacia lingual en los incisivos inferiores.';
            $clinicCase1->hasSecondPhase = false;
            $clinicCase1->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase1->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase1->conclusions = 'Finalmente la evolución del tratamiento de la mordida cruzada anterior tratada con la placa de progenie. consiguió la inversión de la mordida en el paciente';
            $clinicCase1->advices = 'El arco de progenie podría ser pasivo para evitar la proinclinación de incisivos inferiores o activo para lingualizar los incisivos inferiores. Su principal uso es para la mordida cruzada anterior o mordida borde a bode en pacientes de clase I esquelética. Es un aparato tiene un efecto ortodóncico y no se recomienda para realizar ortopedia, por ejemplo para frenar el crecimiento mandibular en una clase III esquelética, ya que el principal efecto que haría sería retroinclinar los incisivos inferiores.';
            $clinicCase1->status = true;
            $clinicCase1->save();

            $comment = new Comment();
            $comment->user_id = $user4->id;
            $comment->clinic_case_id = $clinicCase1->id;
            $comment->content = 'Que buen aporte, me gustaria saber si este proceso es recomendable con dientes de leche?';
            $comment->owner = 'Dr. ' . $user4->name . ' ' . $user4->lastname;
            $comment->save();

            $comment = new Comment();
            $comment->user_id = $user2->id;
            $comment->clinic_case_id = $clinicCase1->id;
            $comment->content = 'Se me presento un caso similar, aplicaré este procedimiento, gracias!';
            $comment->owner = 'Dr. ' . $user2->name . ' ' . $user2->lastname;
            $comment->save();

            $clinicCase2 = new ClinicCase();
            $clinicCase2->user_id = $user->id;
            $clinicCase2->title = 'Mordida cruzada anterior Quad Helix – 03';
            $clinicCase2->description = 'Mordida cruzada anterior tratada con un Quad Helix.';
            $clinicCase2->diagnostic = 'Paciente con 7 años de edad que presenta una mordida cruzada anterior dental (MCAD). En las imágenes intraorales iniciales observamos la mordida cruzada anterior del incisivo central izquierdo superior con el incisivo central izquierdo inferior. La paciente presentaba una clase I molar y canina, junto con una Clase I esquelética.';
            $clinicCase2->treatment_phase_one = 'Debido a un problema de colaboración, se decidió colocar un aparato de ortodoncia fijo, en este caso se optó por un Quad Helix.';
            $clinicCase2->procedure_phase_one = 'Para facilitar las activaciones, se optó por usar un Quad Helix removible, es decir, se remueve el QH y se saca de la boca para las activaciones. Una vez activado, se vuelve a insertar en los cajetines de las bandas de los molares y se fija, de manera temporal, con las ligaduras de los brackets. La activación del Quad Helix fue para proinclinar el incisivo central (2.1). Por lo que la rama izquierda (la del segundo cuadrante) queda totalmente pasiva y apoyada en todos los dientes para tener un mayor anclaje. La rama derecha se va a apoyar en los dientes posteriores de manera pasiva y a nivel anterior solo contactará en el 2.1. La activación se realizó con un alicate de tres puntas a nivel de la linea media para ejercer una presión hacia vestibular sobre el 2.1. Recomiendo una activación de 0.5mm y nunca más de 1mm una vez al mes.';
            $clinicCase2->hasSecondPhase = false;
            $clinicCase2->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase2->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase2->conclusions = 'Aproximadamente en 3-4 se descruzó la mordida y dejamos un mes más el quad helix a modo de retención.';
            $clinicCase2->advices = 'El Quad Helix puede ser una alternativa cuando queremos utilizar un aparato fijo para corregir la mordida cruzada anterior en ortodoncia.';
            $clinicCase2->status = true;
            $clinicCase2->save();

            $clinicCase3 = new ClinicCase();
            $clinicCase3->user_id = $user->id;
            $clinicCase3->title = 'Mordida cruzada anterior Brackets – 04';
            $clinicCase3->description = 'Mordida cruzada anterior tratada con Brackets.';
            $clinicCase3->diagnostic = 'Niño en dentición mixta con Clase I que presenta una mordida cruzada anterior dental (MCAD). En las imágenes intraorales iniciales observamos la mordida cruzada anterior del incisivo central derecho superior con el incisivo central izquierdo inferior junto con una afectación gingival.';
            $clinicCase3->treatment_phase_one = 'En este caso se decidió colocar aparatología fija multibrackets Tip-Edge Plus para corregir la mordida cruzada.';
            $clinicCase3->procedure_phase_one = 'Se colocaron levantes de mordida de ionómero de vidrio en oclusal de 1.6 y 2.6 para aumentar la dimensión vertical y poder así descruzar la mordida.';
            $clinicCase3->hasSecondPhase = true;
            $clinicCase3->treatment_phase_two = 'Se cementaron 4 brackets en los incisivos permanentes junto con 2 tubos en los molares, lo que en ortodoncia se denomina 2×4. Este sistema también se le conoce con el sistema de brackets de autiligado Damon como D-Gainer.';
            $clinicCase3->procedure_phase_two = 'Para proinclinar el incisivo, la biomecánica utilizada fue:
            Arco de 0.013″ de NiTi para ampliar la longitud de arcada.
            Se inserta el arco en el tubo y en los brackets, y se mide la distancia de mesial del tubo a distal del bracket del lateral.
            Ahora cortaremos un Bumper-Sleeve (“macarrón”) 2mm mayor de la distancia que hemos medido.
            Al colocar el Bumper-Sleeve de un tamaño 2mm mayor a la distancia que hay del 16 al 12 y del 22 al 26 se quedará combado y separado de los dientes (ver imagen), por lo que las mejillas y la musculatura ejercerá una presión hacia lingual lo que provocará un efecto protrusor de los incisivos.
            Por último. para controlar el efecto del arco y evitar que se salga, se dobla el arco a ras por distal de los molares 90 grados (lo que también se conoce como cinchar el arco).
            La opción de utilizar Bumper-Sleeve en lugar de muelles es para una mayor comodidad del paciente para que no se le claven los muelles en las mejillas.';
            $clinicCase3->conclusions = 'Se consiguió corregir la mordida cruzada anterior con aproximadamente 8 semanas.';
            $clinicCase3->advices = 'En esta última imagen podemos ver como se ha cerrado el diastema central de los incisivos gracias a la mesialización de estos por el Bumper-Sleeve. Una vez corregida la mordida cruzada, se dejaron los brackets pasivos 4 semanas por si se producía una recidiva. Obsérvese que se pusieron ligaduras elásticas en los brackets para mayor comodidad del paciente (aunque no llevaba arco). En caso de que se quisiese mantener juntos 1.1 y 2.1 se recomienda ligadura metálica en ocho o, mejor aún, retención fija en 1.1 y 2.1 por lingual. Pero en este caso, se decidió dejar los dientes libres.';
            $clinicCase3->status = true;
            $clinicCase3->save();

            $clinicCase4 = new ClinicCase();
            $clinicCase4->user_id = $user3->id;
            $clinicCase4->title = 'Mordida cruzada posterior Pistas Composite – 09';
            $clinicCase4->description = 'Mordida cruzada posterior tratada con pistas de composite y elásticos de ortodoncia';
            $clinicCase4->diagnostic = 'Niño de 5 años con mordida cruzada posterior derecha de los caninos (5.3 y 8.3) y molares temporales (5.5 y 8.5) en dentición mixta. Se decidió realizar un tratamiento de ortodoncia con pistas de composite y tallados.';
            $clinicCase4->treatment_phase_one = 'En primer lugar colocamos composite en el canino cruzado, es decir, en el 5.3, y ajustamos la oclusión llevando al paciente a relación céntrica y donde tallamos 8.3 y 6.3.';
            $clinicCase4->procedure_phase_one = 'En este caso, una vez colocado el composite en el canino cruzado, se vio como se corregía la mordida cruzada a nivel de los caninos, sin embargo, los molares continuaban en mordida cruzada debido al torque negativo del molar superior y torque positivo del molar inferior, por lo que se decidió usar botones y elásticos en los molares.';
            $clinicCase4->hasSecondPhase = false;
            $clinicCase4->treatment_phase_two = 'Se utilizó un elástico de uso nocturno de 3/16″ (4.76mm) de 3.5oz (el elástico de la foto es TP Blue 1/4″ 3.5oz)';
            $clinicCase4->procedure_phase_two = 'Una vez corregida la mordida cruzada posterior de molares, se continuó con revisiones periódicas cada 6 meses.Los molares permanentes del primer y cuarto cuadrante erupcionaron en mordida cruzada, por lo que se procedió a repetir el mismo proceso pero en este caso, en los molares permanentes (1.6 y 4.6).';
            $clinicCase4->conclusions = 'Se consiguió corregir la mordida cruzada posterior en el tiempo estimado.';
            $clinicCase4->advices = ' con una técnica revolucionaria y se procederá a la eliminación del hábito de la masticación unilateral, evitando futuras alteraciones esqueléticas, musculares y articulares. Lo que en el niño se soluciona en apenas media hora, en caso de no tratarse puede derivar a cirugía en el adulto.';
            $clinicCase4->status = true;
            $clinicCase4->save();

        /*for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = 'User' . $i;
            $user->lastname = 'UserLastname';
            $user->email = 'user' . $i . '@user.com';
            $user->password = Hash::make('password');
            $user->gender = 'Mujer';
            $user->role = 'ROLE_USER';
            $user->status = false;
            $user->save();

            $clinicCase1 = new ClinicCase();
            $clinicCase1->user_id = $user->id;
            $clinicCase1->title = 'Mordida cruzada anterior Brackets';
            $clinicCase1->description = 'test description';
            $clinicCase1->diagnostic = 'test diagnostic';
            $clinicCase1->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase1->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase1->hasSecondPhase = false;
            $clinicCase1->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase1->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase1->conclusions = 'Conclusions';
            $clinicCase1->advices = 'Advices';
            $clinicCase1->status = true;
            $clinicCase1->save();

            $clinicCase2 = new ClinicCase();
            $clinicCase2->user_id = $user->id;
            $clinicCase2->title = 'Mordida cruzada posterior Pistas Composite';
            $clinicCase2->description = 'test description';
            $clinicCase2->diagnostic = 'test diagnostic';
            $clinicCase2->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase2->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase2->hasSecondPhase = false;
            $clinicCase2->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase2->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase2->conclusions = 'Conclusions';
            $clinicCase2->advices = 'Advices';
            $clinicCase2->status = true;
            $clinicCase2->save();

            $clinicCase3 = new ClinicCase();
            $clinicCase3->user_id = $user->id;
            $clinicCase3->title = 'Mordida cruzada anterior Quad Helix';
            $clinicCase3->description = 'test description';
            $clinicCase3->diagnostic = 'test diagnostic';
            $clinicCase3->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase3->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase3->hasSecondPhase = false;
            $clinicCase3->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase3->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase3->conclusions = 'Conclusions';
            $clinicCase3->advices = 'Advices';
            $clinicCase3->status = true;
            $clinicCase3->save();

            $clinicCase4 = new ClinicCase();
            $clinicCase4->user_id = $user->id;
            $clinicCase4->title = 'Mordida cruzada anterior Placa Progenie';
            $clinicCase4->description = 'test description';
            $clinicCase4->diagnostic = 'test diagnostic';
            $clinicCase4->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase4->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase4->hasSecondPhase = false;
            $clinicCase4->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase4->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase4->conclusions = 'Conclusions';
            $clinicCase4->advices = 'Advices';
            $clinicCase4->status = true;
            $clinicCase4->save();

            $clinicCase5 = new ClinicCase();
            $clinicCase5->user_id = $user->id;
            $clinicCase5->title = 'Mordida cruzada anterior Pistas Composite';
            $clinicCase5->description = 'test description';
            $clinicCase5->diagnostic = 'test diagnostic';
            $clinicCase5->treatment_phase_one = 'Test treatment text phase one';
            $clinicCase5->procedure_phase_one = 'Test procedure text phase one';
            $clinicCase5->hasSecondPhase = true;
            $clinicCase5->treatment_phase_two = 'Test treatment text phase two';
            $clinicCase5->procedure_phase_two = 'Test procedure text phase two';
            $clinicCase5->conclusions = 'Conclusions';
            $clinicCase5->advices = 'Advices';
            $clinicCase5->status = false;
            $clinicCase5->save();
        }*/
    }
}

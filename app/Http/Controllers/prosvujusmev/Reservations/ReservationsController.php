<?php 

namespace App\Http\Controllers\prosvujusmev\Reservations;

use App\Http\Controllers\Controller;
use App\prosvujusmev\Attendees\Attendee;
use App\prosvujusmev\Attendees\AttendeeAddress;
use App\prosvujusmev\Reservations\Repositories\ReservationRepository;
use App\prosvujusmev\Reservations\Reservation;
use App\prosvujusmev\Reservations\ReservationStatusRecord;
use App\Rules\SourceCode;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index()
    {
        return response()->view('reservations.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'reservations' => 'required|array',
            'reservations.*.sourceCode' => ['required', 'string', 'min:1', 'max:254', new SourceCode],
            'reservations.*.firstName' => 'required|string|min:1|max:254',
            'reservations.*.lastName' => 'required|string|min:1|max:254',
            'reservations.*.email' => 'required|email|max:254',
            'reservations.*.phone' => 'required|string|min:9|max:254',
            'reservations.*.country' => 'required|string|min:1|max:254',
            'reservations.*.street' => 'required|string|min:1|max:254',
            'reservations.*.city' => 'required|string|min:1|max:254',
            'reservations.*.zip' => 'required|string|min:1|max:254',
        ];

        $customMessages = [
            'reservations.*.sourceCode.required' => 'Číslo kupónu je povinné.',
            'reservations.*.sourceCode.string' => 'Číslo kupónu není platné.',
            'reservations.*.sourceCode.min.string' => 'Číslo kupónu není platné.',
            'reservations.*.sourceCode.max.string' => 'Číslo kupónu není platné.',

            'reservations.*.firstName.required' => 'Jméno je povinné.',
            'reservations.*.firstName.string' => 'Jméno není ve spravném formátu.',
            'reservations.*.firstName.min.string' => 'Jméno není ve spravném formátu.',
            'reservations.*.firstName.max.string' => 'Jméno není ve spravném formátu.',

            'reservations.*.lastName.required' => 'Příjmení je povinné.',
            'reservations.*.lastName.string' => 'Příjmení není ve spravném formátu.',
            'reservations.*.lastName.min.string' => 'Příjmení není ve spravném formátu.',
            'reservations.*.lastName.max.string' => 'Přijmení není ve spravném formátu.',

            'reservations.*.email.required' => 'Email je povinný.',
            'reservations.*.email.string' => 'Email není ve spravném formátu.',
            'reservations.*.email.max.string' => 'Email není ve spravném formátu.',

            'reservations.*.phone.required' => 'Telefon je povinný.',
            'reservations.*.phone.string' => 'Telefon není ve spravném formátu.',
            'reservations.*.phone.min.string' => 'Telefon není ve spravném formátu.',
            'reservations.*.phone.max.string' => 'Telefon není ve spravném formátu.',

            'reservations.*.country.required' => 'Stát je povinný.',
            'reservations.*.country.string' => 'Stát není ve spravném formátu.',
            'reservations.*.country.min.string' => 'Stát není ve spravném formátu.',
            'reservations.*.country.max.string' => 'Stát není ve spravném formátu.',

            'reservations.*.street.required' => 'Ulice je povinná.',
            'reservations.*.street.string' => 'Ulice není ve spravném formátu.',
            'reservations.*.street.min.string' => 'Ulice není ve spravném formátu.',
            'reservations.*.street.max.string' => 'Ulice není ve spravném formátu.',

            'reservations.*.city.required' => 'Město je povinné.',
            'reservations.*.city.string' => 'Město není ve spravném formátu.',
            'reservations.*.city.min.string' => 'Město není ve spravném formátu.',
            'reservations.*.city.max.string' => 'Město není ve spravném formátu.',

            'reservations.*.zip.required' => 'PSČ je povinné.',
            'reservations.*.zip.string' => 'PSČ není ve spravném formátu.',
            'reservations.*.zip.min.string' => 'PSČ není ve spravném formátu.',
            'reservations.*.zip.max.string' => 'PSČ není ve spravném formátu.',
        ];

        $this->validate($request, $rules, $customMessages);

        try {
            \DB::beginTransaction();
            foreach ($request->reservations as $reservation) {
                $attendee = Attendee::create([
                    'first_name' => $reservation['firstName'],
                    'last_name' => $reservation['lastName'],
                    'email' => $reservation['email'],
                    'phone' => $reservation['phone'],
                ]);
                $attendeeAddress = AttendeeAddress::create([
                    'country' => $reservation['country'],
                    'city' => $reservation['city'],
                    'street' => $reservation['street'],
                    'zip' => $reservation['zip'],
                    'attendee_id' => $attendee->id,
                ]);
                $reservationModel = Reservation::create([
                    'course_date_id' => $reservation['courseDateId'],
                    'source_type' => 'Slevomat', //$reservation['sourceType'],
                    'source_code' => $reservation['sourceCode'],
                    'status' => Reservation::STATUS_CREATED,
                    'attendee_id' => $attendee->id,
                ]);

                $reservationStatusRecords = ReservationStatusRecord::create([
                    'reservation_id' => $reservationModel->id,
                    'old_status' => null,
                    'new_status' => Reservation::STATUS_CREATED,
                ]);
                app(ReservationRepository::class)->unapprove($reservationModel);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([]);
        }
        return response()->json([]);
    }
}

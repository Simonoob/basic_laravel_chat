<?php




use App\Events\messanger_event;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public string $message = '';
    public array $messages = [];

    // Special Syntax: ['echo:{channel},{event}' => '{method}']
    protected $listeners = ['echo:messages,messanger_event' => 'on_messanger_event'];

    public function send_message(){
        messanger_event::dispatch(Auth::user()->name, $this->message);
        $this->reset('message');
    }


    public function on_messanger_event($event){
    $this->messages[] = $event;
    }
}; ?>

<div>
    <x-chat-dialog :messages="$this->messages" toMethod="send_message" color="red" name="Chat" />
</div>

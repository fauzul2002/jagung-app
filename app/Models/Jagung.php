?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jagung extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function Kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }
}

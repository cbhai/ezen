<?php

namespace App\Http\Livewire\Branding;

use App\Models\Branding;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public Branding $branding;

    public array $mediaToRemove = [];

    public array $mediaCollections = [];

    public function mount(Branding $branding)
    {
        $this->branding         = $branding;
        $this->mediaCollections = [
            'branding_logo' => $branding->logo,
        ];
    }

    public function render()
    {
        return view('livewire.branding.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->branding->save();
        $this->syncMedia();

        return redirect()->route('admin.brandings.index');
    }

    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);

        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();

        $this->mediaToRemove[] = $media['uuid'];
    }

    public function getMediaCollection($name)
    {
        return $this->mediaCollections[$name];
    }

    protected function rules(): array
    {
        return [
            'branding.title' => [
                'string',
                'required',
            ],
            'branding.header' => [
                'string',
                'required',
            ],
            'branding.footer' => [
                'string',
                'required',
            ],
            'mediaCollections.branding_logo' => [
                'array',
                'required',
            ],
            'mediaCollections.branding_logo.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
            ->update(['model_id' => $this->branding->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }
}

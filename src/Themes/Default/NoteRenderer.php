<?php

declare(strict_types=1);

namespace SwooleTW\Hyperf\Prompts\Themes\Default;

use SwooleTW\Hyperf\Prompts\Note;

class NoteRenderer extends Renderer
{
    /**
     * Render the note.
     */
    public function __invoke(Note $note): string
    {
        $lines = explode(PHP_EOL, $note->message);

        switch ($note->type) {
            case 'intro':
            case 'outro':
                $lines = array_map(fn ($line) => " {$line} ", $lines);
                $longest = max(array_map(fn ($line) => strlen($line), $lines));

                foreach ($lines as $line) {
                    $line = str_pad($line, $longest, ' ');
                    $this->line(" {$this->bgCyan($this->black($line))}");
                }

                return (string) $this;
            case 'warning':
                foreach ($lines as $line) {
                    $this->line($this->yellow(" {$line}"));
                }

                return (string) $this;
            case 'error':
                foreach ($lines as $line) {
                    $this->line($this->red(" {$line}"));
                }

                return (string) $this;
            case 'alert':
                foreach ($lines as $line) {
                    $this->line(" {$this->bgRed($this->white(" {$line} "))}");
                }

                return (string) $this;
            case 'info':
                foreach ($lines as $line) {
                    $this->line($this->green(" {$line}"));
                }

                return (string) $this;
            default:
                foreach ($lines as $line) {
                    $this->line(" {$line}");
                }

                return (string) $this;
        }
    }
}

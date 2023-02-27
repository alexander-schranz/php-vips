<?php

namespace Jcupitt\Vips;

class VipsTarget extends Connection
{
    /**
     * A pointer to the underlying VipsTarget. This is the same as the
     * GObject, just cast to VipsTarget to help FFI.
     *
     * @internal
     */
    public \FFI\CData $pointer;

    public function __construct(\FFI\CData $pointer)
    {
        $this->pointer = \FFI::cast(FFI::ctypes('VipsTarget'), $pointer);
        parent::__construct($pointer);
    }

    public static function newToDescriptor(int $descriptor): self
    {
        $pointer = FFI::vips()->vips_target_new_to_descriptor($descriptor);
        if (\FFI::isNull($pointer)) {
            throw new Exception("can't create output target from descriptor $descriptor");
        }

        return new self($pointer);
    }

    public static function newToFile(string $filename): self
    {
        $pointer = FFI::vips()->vips_target_new_to_file($filename);

        if (\FFI::isNull($pointer)) {
            throw new Exception("can't create output target from filename $filename");
        }

        return new self($pointer);
    }

    public static function newToMemory(): self
    {
        $pointer = FFI::vips()->vips_target_new_to_memory();

        if (\FFI::isNull($pointer)) {
            throw new Exception("can't create output target from memory");
        }

        return new self($pointer);
    }
}
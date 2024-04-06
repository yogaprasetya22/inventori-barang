import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm } from "@inertiajs/react";

export default function Add() {
    const { data, setData, post, processing, errors, reset } = useForm({
        nama: "",
        email: "",
        password: "",
        password_confirmation: "",
    });
    const handleAddMekanik = (e) => {
        e.preventDefault();

        post(route("admin.mekanik.store"), {
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_1.close();
                reset();
            },
            onError: (errors) => {
                // jika data password dan password_confirmation tidak sama
                if (data.password !== data.password_confirmation) {
                    errors.password_confirmation = "Password tidak sama";
                    return;
                }
                console.log(errors);
            },
        });
    };
    return (
        <dialog
            id="my_modal_1"
            className="modal backdrop-blur-sm backdrop-brightness-75"
        >
            <div className="modal-box w-full max-w-1xl overflow">
                <div className=" absolute top-0 right-0">
                    <button
                        onClick={() => window.my_modal_1.close()}
                        className="btn-close text-2xl btn bg-transparent border-none"
                        aria-label="close modal"
                    >
                        X
                    </button>
                </div>
                <div className=" w-full flex flex-col gap-5">
                    <div className="w-full flex flex-row justify-center items-center">
                        <h1 className="text-2xl font-bold text-gray-500">
                            Create Mekanik
                        </h1>
                    </div>
                    <form
                        className="flex flex-col gap-5"
                        onSubmit={handleAddMekanik}
                    >
                        <div className="flex flex-col gap-2">
                            {/* buatkan label input yang mana isinya ada nama email	role*/}
                            <div className="flex flex-col gap-2 w-full">
                                <InputLabel htmlFor="nama" value="Nama" />
                                <TextInput
                                    id="nama"
                                    type="text"
                                    name="nama"
                                    value={data.nama}
                                    className="mt-1 block w-full"
                                    autoComplete="nama"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("nama", e.target.value)
                                    }
                                />
                                <InputError
                                    message={errors.nama}
                                    className="mt-2"
                                />
                            </div>
                            <div className="flex flex-col gap-2 w-full">
                                <InputLabel htmlFor="email" value="Email" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    name="email"
                                    value={data.email}
                                    className="mt-1 block w-full"
                                    autoComplete="email"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("email", e.target.value)
                                    }
                                />
                                <InputError
                                    message={errors.email}
                                    className="mt-2"
                                />
                            </div>
                            <div className="mt-4">
                                <InputLabel
                                    htmlFor="password"
                                    value="Password"
                                />

                                <TextInput
                                    id="password"
                                    type="password"
                                    name="password"
                                    value={data.password}
                                    className="mt-1 block w-full"
                                    autoComplete="current-password"
                                    onChange={(e) =>
                                        setData("password", e.target.value)
                                    }
                                />

                                <InputError
                                    message={errors.password}
                                    className="mt-2"
                                />
                            </div>
                            {/* confirm password */}
                            <div className="mt-4">
                                <InputLabel
                                    htmlFor="password_confirmation"
                                    value="Password Confirmation"
                                />

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    value={data.password_confirmation}
                                    className="mt-1 block w-full"
                                    autoComplete="current-password"
                                    onChange={(e) =>
                                        setData(
                                            "password_confirmation",
                                            e.target.value
                                        )
                                    }
                                />

                                <InputError
                                    message={errors.password_confirmation}
                                    className="mt-2"
                                />
                            </div>
                        </div>
                        <div className="flex justify-end">
                            <button
                                type="submit"
                                className="btn bg-indigo-600/90 text-white"
                            >
                                {processing ? "Loading..." : "Create"}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    );
}

import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm } from "@inertiajs/react";
import { useEffect } from "react";

export default function Update({ data: data_mekanik }) {
    const { data, setData, put, processing, errors, reset } = useForm({
        id: "",
        nama: "",
        email: "",
        password: "",
        password_confirmation: "",
    });
    useEffect(() => {
        setData({
            id: data_mekanik.id,
            nama: data_mekanik.name,
            email: data_mekanik.email,
        });
    }, [data_mekanik]);

    const handleAddMekanik = (e) => {
        e.preventDefault();

        put(route("admin.mekanik.update"), {
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_2.close();
                reset();
            },
            onError: (errors) => {
                if (errors.password) {
                    reset("password", "password_confirmation");
                    passwordInput.current.focus();
                }

                if (errors.current_password) {
                    reset("current_password");
                    currentPasswordInput.current.focus();
                }
            },
        });
    };
    return (
        <dialog
            id="my_modal_2"
            className="modal backdrop-blur-sm backdrop-brightness-75"
        >
            <div className="modal-box w-full max-w-1xl overflow">
                <div className=" absolute top-0 right-0">
                    <button
                        onClick={() => window.my_modal_2.close()}
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
                                <InputLabel
                                    htmlFor="update_nama"
                                    value="Nama"
                                />
                                <TextInput
                                    id="update_nama"
                                    type="text"
                                    name="update_nama"
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
                                <InputLabel
                                    htmlFor="update_email"
                                    value="Email"
                                />
                                <TextInput
                                    id="update_email"
                                    type="email"
                                    name="update_email"
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
                                    htmlFor="update_password"
                                    value="Password"
                                />

                                <TextInput
                                    id="update_password"
                                    type="password"
                                    name="update_password"
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
                                    htmlFor="update_password_confirmation"
                                    value="Password Confirmation"
                                />

                                <TextInput
                                    id="update_password_confirmation"
                                    type="password"
                                    name="update_password_confirmation"
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
